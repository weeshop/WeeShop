<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes for the "item_list__bootstrap_carousel_indicators" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("item_list__bootstrap_carousel_indicators")
 */
class ItemListBootstrapCarouselIndicators extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  protected function preprocessVariables(Variables $variables) {
    parent::preprocessVariables($variables);

    $variables->target = $variables->getContext('target');
    $variables->start_index = $variables->getContext('start_index');
  }

}
