<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\bootstrap\Theme;

/**
 * Manages discovery and instantiation of Bootstrap preprocess hooks.
 *
 * @ingroup plugins_preprocess
 */
class PreprocessManager extends PluginManager {

  /**
   * Constructs a new \Drupal\bootstrap\Plugin\PreprocessManager object.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme to use for discovery.
   */
  public function __construct(Theme $theme) {
    parent::__construct($theme, 'Plugin/Preprocess', 'Drupal\bootstrap\Plugin\Preprocess\PreprocessInterface', 'Drupal\bootstrap\Annotation\BootstrapPreprocess');
    $this->setCacheBackend(\Drupal::cache('discovery'), 'theme:' . $theme->getName() . ':preprocess', $this->getCacheTags());
  }

}
