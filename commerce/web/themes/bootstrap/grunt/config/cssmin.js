module.exports = function (grunt, options) {
  return {
    options: {
      report: 'gzip'
    },
    css: {
      files: [{
        expand: true,
        cwd: 'css',
        src: ['**/*.css', '!**/*.min.css'],
        dest: 'css',
        ext: '.min.css'
      }]
    },
    dev: {
      files: [{
        expand: true,
        cwd: 'css',
        src: ['<%= latestVersion %>/overrides.css'],
        dest: 'css',
        ext: '.min.css'
      }]
    }
  }
}
