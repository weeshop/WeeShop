module.exports = function (grunt, options, arg1, arg2) {
  return {
    css: ['css/**/*.css'],
    dev: ['css/<%= latestVersion %>/overrides.css']
  };
};
