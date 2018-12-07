<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "input__button" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("input__button")
 */
class InputButton extends Input implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessElement(Element $element, Variables $variables) {
    $element->colorize();
    $element->setButtonSize();
    $element->setIcon($element->getProperty('icon'));
    $variables['icon_only'] = $element->getProperty('icon_only');
    $variables['icon_position'] = $element->getProperty('icon_position');
    $variables['label'] = $element->getProperty('value');
    if ($element->getProperty('split')) {
      $variables->map([$variables::SPLIT_BUTTON]);
    }
    parent::preprocessElement($element, $variables);
  }

}
