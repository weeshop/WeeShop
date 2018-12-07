<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "page" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("page")
 */
class Page extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    // Setup default attributes.
    $variables->getAttributes($variables::NAVBAR);
    $variables->getAttributes($variables::HEADER);
    $variables->getAttributes($variables::CONTENT);
    $variables->getAttributes($variables::FOOTER);
    $this->preprocessAttributes();
  }

}
