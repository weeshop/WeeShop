module.exports = function (grunt) {
  'use strict';

  // Register the 'sync' task.
  grunt.registerTask('sync', 'Syncs necessary libraries for development purposes. Read more in: MAINTAINERS.md.', function () {
    var cwd = process.cwd();
    var force = grunt.option('force');
    var path = require('path');
    var pkg = require('../package');

    // Internal variables.
    var libraries = {};
    var librariesCache = path.join(cwd, pkg.caches.libraries);
    var librariesPath = path.join(cwd, pkg.paths.libraries);
    var exists = grunt.file.exists(librariesCache);
    var expired = false;

    // Determine the validity of any existing cached libraries file.
    if (!force && exists) {
      grunt.verbose.write('Cached library information detected, checking...');
      var fs = require('fs');
      var stat = fs.statSync(librariesCache);
      var now = new Date().getTime();
      var expire = new Date(stat.mtime);
      expire.setDate(expire.getDate() + 7); // 1 week
      expired = now > expire.getTime();
      grunt.verbose.writeln((expired ? 'EXPIRED' : 'VALID')[expired ? 'red' : 'green']);
    }

    // Register a private sub-task. Doing this inside the main task prevents
    // this private sub-task from being executed directly and also prevents it
    // from showing up on the list of available tasks on --help.
    grunt.registerTask('sync:api', function () {
      var done = this.async();
      var request = require('request');
      grunt.verbose.write(pkg.urls.jsdelivr + ' ');
      request(pkg.urls.jsdelivr, function (error, response, body) {
        if (!error && response.statusCode == 200) {
          grunt.verbose.ok();
          var json;
          grunt.verbose.write("\nParsing JSON response...");
          try {
            json = JSON.parse(body);
            grunt.verbose.ok();
          } catch (e) {
            grunt.verbose.error();
            throw grunt.util.error('Unable to parse the response value (' + e.message + ').', e);
          }
          grunt.verbose.write("\nExtracting versions and themes from libraries...");
          libraries = {};
          json.forEach(function (library) {
            if (library.name === 'bootstrap' || library.name === 'bootswatch') {
              library.assets.forEach(function (asset) {
                if (asset.version.match(/^3.\d\.\d$/)) {
                  if (!libraries[library.name]) libraries[library.name] = {};
                  if (!libraries[library.name][asset.version]) libraries[library.name][asset.version] = {};
                  asset.files.forEach(function (file) {
                    if (!file.match(/bootstrap\.min\.css$/)) return;
                    if (library.name === 'bootstrap') {
                      libraries[library.name][asset.version]['bootstrap'] = true;
                    }
                    else {
                      libraries[library.name][asset.version][file.split(path.sep)[0]] = true;
                    }
                  });
                }
              });
            }
          });
          grunt.verbose.ok();

          // Flatten themes.
          for (var library in libraries) {
            grunt.verbose.header(library);
            if (!libraries.hasOwnProperty(library)) continue;
            var versions = Object.keys(libraries[library]);
            grunt.verbose.ok('Versions: ' + versions.join(', '));
            var themeCount = 0;
            for (var version in libraries[library]) {
              if (!libraries[library].hasOwnProperty(version)) continue;
              var themes = Object.keys(libraries[library][version]).sort();
              libraries[library][version] = themes;
              if (themes.length > themeCount) {
                themeCount = themes.length;
              }
            }
            grunt.verbose.ok(grunt.util.pluralize(themeCount, 'Themes: 1/Themes: ' + themeCount));
          }
          grunt.verbose.writeln();
          grunt.file.write(librariesCache, JSON.stringify(libraries, null, 2));

          grunt.log.ok('Synced');
        }
        else {
          grunt.verbose.error();
          if (error) grunt.verbose.error(error);
          grunt.verbose.error('Request URL: ' + pkg.urls.jsdelivr);
          grunt.verbose.error('Status Code: ' + response.statusCode);
          grunt.verbose.error('Response Headers: ' + JSON.stringify(response.headers, null, 2));
          grunt.verbose.error('Response:');
          grunt.verbose.error(body);
          grunt.fail.fatal('Unable to establish a connection. Run with --verbose to view the response received.');
        }
        return done(error);
      });
    });

    // Run API sync sub-task.
    if (!exists || force || expired) {
      if (!exists) grunt.verbose.writeln('No libraries cache detected, syncing libraries.');
      else if (force) grunt.verbose.writeln('Forced option detected, syncing libraries.');
      else if (expired) grunt.verbose.writeln('Libraries cache is over a week old, syncing libraries.');
      grunt.task.run(['sync:api']);
    }

    // Register another private sub-task.
    grunt.registerTask('sync:libraries', function () {
      var bower = require('bower');
      var done = this.async();
      var inquirer =  require('inquirer');
      var queue = require('queue')({concurrency: 1, timeout: 60000});
      if (!grunt.file.exists(librariesCache)) {
        return grunt.fail.fatal('No libraries detected. Please run `grunt sync --force`.');
      }
      libraries = grunt.file.readJSON(librariesCache);
      var bowerJson = path.join(cwd, 'bower.json');
      if (!grunt.file.isDir(librariesPath)) grunt.file.mkdir(librariesPath);

      // Iterate over libraries.
      for (var library in libraries) {
        if (!libraries.hasOwnProperty(library)) continue;

        // Iterate over versions.
        for (var version in libraries[library]) {
          if (!libraries[library].hasOwnProperty(version)) continue;

          var endpoint = library + '#' + version;

          // Check if library is already installed. If so, skip.
          var versionPath = path.join(librariesPath, version);
          grunt.verbose.write('Checking ' + endpoint + '...');
          if (grunt.file.isDir(versionPath) && grunt.file.isDir(versionPath + '/' + library)) {
            grunt.verbose.writeln('INSTALLED'.green);
            continue;
          }

          grunt.verbose.writeln('MISSING'.red);
          grunt.file.mkdir(versionPath);
          grunt.file.copy(bowerJson, path.join(versionPath, 'bower.json'));

          var config = {
            cwd: versionPath,
            directory: '',
            interactive: true,
            scripts: {
              postinstall: 'rm -rf jquery && rm -rf font-awesome'
            }
          };

          // Enqueue bower installations.
          (function (endpoint, config) {
            queue.push(function (done) {
              bower.commands
                .install([endpoint], {saveDev: true}, config)
                .on('log', function (result) {
                  if (result.level === 'action' && result.id !== 'validate' && !result.message.match(/(jquery|font-awesome)/)) {
                    grunt.log.writeln(['bower', result.id.cyan, result.message.green].join(' '));
                  }
                  else if (result.level === 'action') {
                    grunt.verbose.writeln(['bower', result.id.cyan, result.message.green].join(' '));
                  }
                  else {
                    grunt.log.debug(['bower', result.id.cyan, result.message.green].join(' '));
                  }
                })
                .on('prompt', function (prompts, callback) {
                  inquirer.prompt(prompts, callback);
                })
                .on('end', function () { done() })
              ;
            });
          })(endpoint, config);
        }
      }

      // Start bower queue.
      queue.start(function (e) {
        return done(e);
      });
    });

    // Run private sub-task.
    grunt.task.run(['sync:libraries']);
  });

}
