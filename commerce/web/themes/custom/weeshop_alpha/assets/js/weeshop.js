(function ($, Drupal) {
  Drupal.behaviors.addToCartPanel = {
    attach: function (context, settings) {
      $('.add-card').once('addToCartPanel').each(function () {
        $(this).click(function (event) {
          var pid = $(this).data('pid');
          var pic = $('#product-item-pic' + pid);
          var pan = $('#add-to-cart-panel-p' + pid);
          pan.css('width', pic.width());
          pan.css('min-height', pic.height());
          pan.addClass('show');
          pan.mouseleave(function () {
            $(this).removeClass('show');
          });
        })
      })
    }
  }

})(jQuery, Drupal);
