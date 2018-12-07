<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

/**
 * Defines the interface for an object oriented preprocess plugin.
 *
 * @ingroup plugins_preprocess
 */
interface PreprocessInterface {

  /**
   * Preprocess theme hook variables.
   *
   * @param array $variables
   *   The variables array, passed by reference (modify in place).
   * @param string $hook
   *   The name of the theme hook.
   * @param array $info
   *   The theme hook info array.
   */
  public function preprocess(array &$variables, $hook, array $info);

}
