module.exports = function (grunt, options) {
  return {
    less: {
      files: ['starterkits/less/**/*.less'],
      tasks: ['compile']
    }
  }
}
