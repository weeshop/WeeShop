/**
 * @file
 * Theme hooks for the Drupal Bootstrap base theme.
 */
(function ($, Drupal) {

  if (Drupal.ImageWidgetCrop && Drupal.ImageWidgetCrop.prototype && Drupal.ImageWidgetCrop.prototype.selectors && Drupal.ImageWidgetCrop.prototype.selectors.summary) {
    Drupal.ImageWidgetCrop.prototype.selectors.summary += ', > .panel-heading > .panel-title';
  }

})(window.jQuery, window.Drupal);
