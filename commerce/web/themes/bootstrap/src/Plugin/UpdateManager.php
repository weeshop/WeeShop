<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\bootstrap\Theme;
use Drupal\Component\Utility\SortArray;

/**
 * Manages discovery and instantiation of Bootstrap updates.
 *
 * @ingroup plugins_update
 */
class UpdateManager extends PluginManager {

  /**
   * Constructs a new \Drupal\bootstrap\Plugin\UpdateManager object.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme to use for discovery.
   */
  public function __construct(Theme $theme) {
    // Unlike other plugins in this base theme, this one should only discover
    // update plugins that are unique to its own theme to avoid plugin ID
    // collision (e.g. base and sub-theme both implement an update plugin
    // with the id "8001").
    $this->namespaces = new \ArrayObject(['Drupal\\' . $theme->getName() => [DRUPAL_ROOT . '/' . $theme->getPath() . '/src']]);

    $this->theme = $theme;
    $this->subdir = 'Plugin/Update';
    $this->pluginDefinitionAnnotationName = 'Drupal\bootstrap\Annotation\BootstrapUpdate';
    $this->pluginInterface = 'Drupal\bootstrap\Plugin\Update\UpdateInterface';
    $this->themeHandler = \Drupal::service('theme_handler');
    $this->themeManager = \Drupal::service('theme.manager');
    $this->setCacheBackend(\Drupal::cache('discovery'), 'theme:' . $theme->getName() . ':update', $this->getCacheTags());
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinitions($sorted = TRUE) {
    $definitions = parent::getDefinitions();

    // Sort by the schema number (a.k.a. plugin ID).
    if ($sorted) {
      uasort($definitions, function ($a, $b) {
        return SortArray::sortByKeyInt($a, $b, 'id');
      });
    }

    return $definitions;
  }

  /**
   * Retrieves the latest update schema.
   *
   * @return int|array
   *   The latest update schema.
   */
  public function getLatestSchema() {
    $schema = \Drupal::CORE_MINIMUM_SCHEMA_VERSION;
    if ($schemas = $this->getSchemas()) {
      $schema = max(max($schemas), $schema);
    }
    return $schema;
  }

  /**
   * Retrieves any pending updates.
   *
   * @param bool $private
   *   Toggle determining whether or not to include private updates, intended
   *   for only the theme that created it. Defaults to: FALSE.
   *
   * @return \Drupal\bootstrap\Plugin\Update\UpdateInterface[]
   *   An associative array containing update objects, keyed by their version.
   */
  public function getPendingUpdates($private = FALSE) {
    $pending = [];
    $installed = $this->theme->getSetting('schemas', []);
    foreach ($this->getUpdates($private) as $version => $update) {
      if ($version > $installed) {
        $pending[$version] = $update;
      }
    }
    return $pending;
  }

  /**
   * Retrieves update plugins for the theme.
   *
   * @param bool $private
   *   Toggle determining whether or not to include private updates, intended
   *   for only the theme that created it. Defaults to: FALSE.
   *
   * @return \Drupal\bootstrap\Plugin\Update\UpdateInterface[]
   *   An associative array containing update objects, keyed by their version.
   */
  public function getUpdates($private = FALSE) {
    $updates = [];
    foreach ($this->getSchemas($private) as $schema) {
      $updates[$schema] = $this->createInstance($schema, ['theme' => $this->theme]);
    }
    return $updates;
  }

  /**
   * Retrieves the update schema identifiers.
   *
   * @param bool $private
   *   Toggle determining whether or not to include private updates, intended
   *   for only the theme that created it. Defaults to: FALSE.
   *
   * @return array
   *   An indexed array of schema identifiers.
   */
  protected function getSchemas($private = FALSE) {
    $definitions = $this->getDefinitions();

    // Remove private updates.
    if (!$private) {
      foreach ($definitions as $plugin_id => $definition) {
        if (!empty($definition['private'])) {
          unset($definitions[$plugin_id]);
        }
      }
    }

    return array_keys($definitions);
  }

  /*************************
   * Deprecated methods.
   *************************/

  /**
   * Retrieves the latest update schema.
   *
   * @return int
   *   The latest update schema.
   *
   * @deprecated 8.x-3.0-rc2, will be removed before 8.x-3.0 is released.
   *
   * @see \Drupal\bootstrap\Plugin\UpdateManager::getLatestSchema
   */
  public function getLatestVersion() {
    return $this->getLatestSchema();
  }

}
