<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "field_multiple_value_form" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("field_multiple_value_form")
 */
class FieldMultipleValueForm extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessElement(Element $element, Variables $variables) {
    // Wrap header columns in label element for Bootstrap.
    if ($variables['multiple']) {
      $header = [
        [
          'data' => [
            '#prefix' => '<label class="label">',
            'title' => ['#markup' => $element->getProperty('title')],
            '#suffix' => '</label>',
          ],
          'colspan' => 2,
          'class' => [
            'field-label',
            !empty($element['#required']) ? 'form-required' : '',
          ],
        ],
        t('Order', [], ['context' => 'Sort order']),
      ];

      $variables['table']['#header'] = $header;
    }
  }

}
