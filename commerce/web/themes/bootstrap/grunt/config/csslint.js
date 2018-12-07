module.exports = function () {
  return {
    options: {
      csslintrc: '.csslintrc'
    },
    css: {
      src: ['css/**/*.css']
    },
    dev: {
      src: ['css/<%= latestVersion %>/overrides.min.css']
    }
  };
};
