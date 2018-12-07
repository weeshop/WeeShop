var path = require('path');

module.exports = function (grunt) {
  // Record grunt task execution times. Must be first.
  require('time-grunt')(grunt);

  // Register the "default" task.
  grunt.registerTask('default', ['compile']);

  // Register the "install" task.
  grunt.registerTask('install', 'Installs or re-installs this grunt project. Read more in: docs/project/grunt.md.', ['githooks', 'sync', 'clean-vendor-dirs']);

  // Load custom tasks.
  grunt.task.loadTasks('grunt');

  // Load npm installed 'grunt-*' tasks and configurations.
  require('load-grunt-config')(grunt, {
    configPath: path.join(process.cwd(), 'grunt', 'config')
  });
};
