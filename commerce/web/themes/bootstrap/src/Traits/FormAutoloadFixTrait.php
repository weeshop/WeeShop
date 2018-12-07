<?php

namespace Drupal\bootstrap\Traits;

use Drupal\bootstrap\Bootstrap;
use Drupal\Core\Form\FormStateInterface;

/**
 * Trait FormAutoloadFixTrait.
 */
trait FormAutoloadFixTrait {

  /**
   * Adds the autoload fix include file to the form state.
   *
   * This may be necessary if you notice your AJAX callbacks not working.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state object.
   */
  public static function formAutoloadFix(FormStateInterface $form_state) {
    $files = $form_state->getBuildInfo()['files'];

    // Only add the include once.
    $file = Bootstrap::autoloadFixInclude();
    $key = array_search($file, $files);
    if ($key === FALSE) {
      array_unshift($files, $file);
      $form_state->addBuildInfo('files', $files);
    }
  }

}
