(function ($, Drupal) {
  Drupal.behaviors.languageSelect = {
    attach: function (context, settings) {
      $('div.select_language select', context).once('languageSelect').each(function () {
        var selectObject = this;
        $(this).find('option').each(function () {
          console.log(this, $(this).data('langcode') + ':' + settings.path.currentLanguage);
          if ($(this).data('langcode') === settings.path.currentLanguage) {
            $(selectObject).selectpicker('val', $(this).data('content'));
            console.log(this);
          }
        })

        $(this).change(function() {
          var value = $(this).val();
          $(this).find('option').each(function () {
            if ($(this).data('content') === value) {
              window.location.href = $(this).data('url');
            }
          })
        });
      });
    }
  };
})(jQuery, Drupal);