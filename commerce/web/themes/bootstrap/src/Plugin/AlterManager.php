<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\bootstrap\Theme;

/**
 * Manages discovery and instantiation of Bootstrap hook alters.
 *
 * @ingroup plugins_alter
 */
class AlterManager extends PluginManager {

  /**
   * Constructs a new \Drupal\bootstrap\Plugin\AlterManager object.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme to use for discovery.
   */
  public function __construct(Theme $theme) {
    parent::__construct($theme, 'Plugin/Alter', 'Drupal\bootstrap\Plugin\Alter\AlterInterface', 'Drupal\bootstrap\Annotation\BootstrapAlter');
    $this->setCacheBackend(\Drupal::cache('discovery'), 'theme:' . $theme->getName() . ':alter', $this->getCacheTags());
  }

}
