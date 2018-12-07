<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Variables;
use Drupal\Component\Utility\Html;

/**
 * Pre-processes variables for the "progress_bar" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("progress_bar")
 */
class ProgressBar extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    // Ensure a unique ID, generating one if needed.
    $id = $variables->getAttribute('id', Html::getUniqueId($variables->offsetGet('id', 'progress-bar')));
    $variables->setAttribute('id', $id);
    unset($variables['id']);

    // Preprocess attributes.
    $this->preprocessAttributes();
  }

}
