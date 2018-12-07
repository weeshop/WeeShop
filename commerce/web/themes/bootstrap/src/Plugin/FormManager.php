<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\bootstrap\Theme;

/**
 * Manages discovery and instantiation of Bootstrap form alters.
 *
 * @ingroup plugins_form
 */
class FormManager extends PluginManager {

  /**
   * Constructs a new \Drupal\bootstrap\Plugin\FormManager object.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme to use for discovery.
   */
  public function __construct(Theme $theme) {
    parent::__construct($theme, 'Plugin/Form', 'Drupal\bootstrap\Plugin\Form\FormInterface', 'Drupal\bootstrap\Annotation\BootstrapForm');
    $this->setCacheBackend(\Drupal::cache('discovery'), 'theme:' . $theme->getName() . ':form', $this->getCacheTags());
  }

}
