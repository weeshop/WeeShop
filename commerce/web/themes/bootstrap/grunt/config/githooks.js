module.exports = function (grunt, options) {
  return {
    install: {
      options: {
        template: '.githooks.js.hbs'
      },
      // Change to something else once the {{ hook }} variable can be used.
      // @see https://github.com/wecodemore/grunt-githooks/pull/40
      'pre-commit': 'pre-commit',
      'post-merge': 'post-merge',
      'post-checkout': 'post-checkout',
      'post-commit': 'post-commit'
    }
  };
};
