module.exports = function (grunt, options) {
  'use strict';

  // Register the "clean-vendor-dirs" task.
  grunt.registerTask('clean-vendor-dirs', 'Ensures vendor directories do not cause Drupal to segfault. Read more in: MAINTAINERS.md.', function () {
    var glob = [
      'node_modules/**/*.info',
      'bower_components/**/*.info',
      'lib/**/*.info'
    ];
    var files = grunt.file.expand(glob);
    if (files.length) {
      files.forEach(function (file) {
        grunt.log.ok('Removed ' + file);
        grunt.file.delete(file, {force: true});
      });
    }
    grunt.log.ok('Vendor directories clean!');
  });

};
