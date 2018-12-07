var pkg = require('../package');

module.exports = function (grunt) {
  'use strict';

  var dev = !!grunt.option('dev');
  var path, cssPath, libraries, librariesCache, librariesPath, versions, latestVersion;

  // Helper function for falling back to a Bootstrap variables file.
  var resolveVariables = function (file, backup) {
    if (backup === true) grunt.verbose.write('Checking for backup variables file...');
    if (!grunt.file.exists(path.join(librariesPath, file))) {
      if (backup === true) grunt.verbose.warn();
      grunt.verbose.writeln("Missing " + file);
      file = false;
      if (backup && backup !== true) {
        file = resolveVariables(backup, true);
        if (file) grunt.verbose.writeln("Using: " + file);
      }
      return file;
    }
    else if (backup === true) grunt.verbose.ok();
    return file;
  };

  // Register the "compile" task.
  grunt.registerTask('compile', 'Compiles the Drupal/Bootstrap override CSS files for the base theme.', function () {
    var cwd = process.cwd();
    path = require('path');
    cssPath = path.join(cwd, pkg.paths.css);
    librariesCache = path.join(cwd, pkg.caches.libraries);
    librariesPath = path.join(cwd, pkg.paths.libraries);
    if (!grunt.file.exists(librariesCache) || !grunt.file.isDir(librariesPath)) {
      return grunt.fail.fatal('No libraries detected. Please run `grunt sync`.');
    }

    libraries = grunt.file.readJSON(librariesCache);
    if (!libraries.bootstrap || !libraries.bootswatch) {
      return grunt.fail.fatal('Invalid libraries cache. Please run `grunt sync`.');
    }

    versions = Object.keys(libraries.bootstrap);
    latestVersion = [].concat(versions).pop();
    grunt.config.set('latestVersion', latestVersion);

    // Register a private sub-task. Doing this inside the main task prevents
    // this private sub-task from being executed directly and also prevents it
    // from showing up on the list of available tasks on --help.
    grunt.registerTask('compile:overrides', function () {
      var done = this.async();
      var total = {count: 0};
      var less = require('less');
      var LessPluginAutoPrefix = require('less-plugin-autoprefix');
      var LessPluginCleanCSS = require('less-plugin-clean-css');
      var lessPlugins = [
        new LessPluginCleanCSS({
          advanced: true
        }),
        new LessPluginAutoPrefix({
          browsers: [
            "Android 2.3",
            "Android >= 4",
            "Chrome >= 20",
            "Firefox >= 24",
            "Explorer >= 8",
            "iOS >= 6",
            "Opera >= 12",
            "Safari >= 6"
          ],
          map: true
        })
      ];
      var queue = require('queue')({concurrency: 1, timeout: 60000});

      // Iterate over libraries.
      for (var library in libraries) {
        if (!libraries.hasOwnProperty(library) || (dev && library !== 'bootstrap')) continue;
        // Iterate over versions.
        for (var version in libraries[library]) {
          if (!libraries[library].hasOwnProperty(version) || (dev && version !== latestVersion)) continue;
          // Iterate over themes.
          for (var i = 0; i < libraries[library][version].length; i++) {
            // Queue LESS compilations.
            (function (library, versions, version, theme, total) {
              queue.push(function (done) {
                var lessPaths = [path.join(librariesPath)];
                var latestVersion = [].concat(versions).pop();
                var latestVariables = path.join(latestVersion, 'bootstrap', 'less', 'variables.less');
                var latestMixins = path.join(latestVersion, 'bootstrap', 'less', 'mixins.less');
                var themeVariables = path.join(version, library, (library === 'bootstrap' ? 'less' : theme), 'variables.less');
                var backupVariables = path.join(version, 'bootstrap', 'less', 'variables.less');
                var fileName = (library === 'bootstrap' ? 'overrides.min.css' : 'overrides-' + theme + '.min.css');
                var outputFile = path.join(cssPath, version, fileName);

                // Resolve the variable files.
                latestVariables = resolveVariables(latestVariables);
                if (!latestVariables) return done(false);
                themeVariables = resolveVariables(themeVariables, backupVariables);
                if (!themeVariables) return grunt.fail.fatal("Unable to create: " + outputFile);

                var options = {
                  filename: outputFile,
                  paths: lessPaths,
                  plugins: lessPlugins
                };
                var imports = [
                  // First, import the latest bootstrap (missing variables).
                  '@import "' + latestVariables + '"',
                  // Then, override variables with theme.
                  '@import "' + themeVariables + '"',
                  // Then, import latest bootstrap mixins.
                  '@import "' + latestMixins + '"',
                  // Finally, import the base-theme overrides.
                  '@import "' + path.join('starterkits', 'less', 'less', 'overrides.less') + '"'
                ];
                grunt.log.debug("\noptions: " + JSON.stringify(options, null, 2));
                grunt.log.debug(imports.join("\n"));
                less.render(imports.join(';') + ';', options)
                  .then(function (output) {
                    total.count++;
                    grunt.log.writeln('Compiled '.green + path.join(version, fileName).white.bold);
                    grunt.file.write(outputFile, output.css);
                    done();
                  }, function (e) {
                    if (e.type === 'Parse') {
                      grunt.log.error("File:\t".red + e.filename.red);
                      grunt.log.error("Line:\t".red + [e.line, e.column].join(':').red);
                      grunt.log.error("Code:\t".red + e.extract.join('').white.bold);
                      grunt.log.writeln();
                    }
                    return grunt.fail.fatal(e);
                  })
                ;
              });
            })(library, Object.keys(libraries[library]), version, libraries[library][version][i], total);
          }
        }
      }

      // Start LESS compilations queues.
      queue.start(function (e) {
        // Report how many files were compiled.
        grunt.log.ok(grunt.util.pluralize(total.count, '1 file compiled./' + total.count + ' files compiled.'));
        return done(e);
      });
    });

    // Run necessary sub-tasks.
    var subtask = (dev ? 'dev' : 'css');
    grunt.task.run([
      'clean:' + subtask,
      'compile:overrides',
      'csslint:' + subtask
    ]);
  });

};
