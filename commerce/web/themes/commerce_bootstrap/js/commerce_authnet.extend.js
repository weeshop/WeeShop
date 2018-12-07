(function ($, Drupal) {
  /**
   * Add necessary theming hooks.
   */
  $.extend(Drupal.theme, /** @lends Drupal.theme */{
    commerceAuthorizeNetError: function (message) {
      return $('<div class="messages messages--error alert alert-danger alert-dismissible"></div>').html(message);
    }
  });
})(window.jQuery, window.Drupal);
