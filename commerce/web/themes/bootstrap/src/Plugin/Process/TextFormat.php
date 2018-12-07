<?php

namespace Drupal\bootstrap\Plugin\Process;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Processes the "text_format" element.
 *
 * @ingroup plugins_process
 *
 * @BootstrapProcess("text_format")
 *
 * @see \Drupal\filter\Element\TextFormat::processFormat()
 */
class TextFormat extends ProcessBase implements ProcessInterface {

  /**
   * {@inheritdoc}
   */
  public static function processElement(Element $element, FormStateInterface $form_state, array &$complete_form) {
    // Don't add the form-group class to the actual textarea element since
    // text_format elements are already wrapped.
    $element->value->setProperty('form_group', FALSE);

    if (isset($element->format)) {
      $element->format->addClass('form-inline');

      // Guidelines (removed).
      $element->format->guidelines->setProperty('access', FALSE);

      // Format (select).
      $element->format->format
        ->addClass('input-sm')
        ->setProperty('title_display', 'invisible')
        ->setProperty('weight', -10);

      // Help (link).
      $element->format->help->about
        ->setAttribute('title', t('Opens in new window'))
        ->setProperty('icon', Bootstrap::glyphicon('question-sign'));
      if (Bootstrap::getTheme()->getSetting('tooltip_enabled')) {
        $element->format->help->about->setAttribute('data-toggle', 'tooltip');
      }
    }
  }

}
