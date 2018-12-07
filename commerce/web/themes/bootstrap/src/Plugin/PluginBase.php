<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\Core\Plugin\PluginBase as CorePluginBase;
use Drupal\bootstrap\Bootstrap;

/**
 * Base class for an update.
 *
 * @ingroup utility
 */
class PluginBase extends CorePluginBase {

  /**
   * The currently set theme object.
   *
   * @var \Drupal\bootstrap\Theme
   */
  protected $theme;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    if (!isset($configuration['theme'])) {
      $configuration['theme'] = Bootstrap::getTheme();
    }
    $this->theme = $configuration['theme'];
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

}
