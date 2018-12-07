<?php

namespace Drupal\bootstrap\Plugin;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Theme;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Base class for Bootstrap plugin managers.
 *
 * @ingroup utility
 */
class PluginManager extends DefaultPluginManager {

  /**
   * The current theme.
   *
   * @var \Drupal\bootstrap\Theme
   */
  protected $theme;

  /**
   * The theme handler to check if theme exists.
   *
   * @var \Drupal\Core\Extension\ThemeHandlerInterface
   */
  protected $themeHandler;

  /**
   * The theme manager to invoke alter hooks.
   *
   * @var \Drupal\Core\Theme\ThemeManager
   */
  protected $themeManager;

  /**
   * Creates the discovery object.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme to use for discovery.
   * @param string|bool $subdir
   *   The plugin's subdirectory, for example Plugin/views/filter.
   * @param string|null $plugin_interface
   *   (optional) The interface each plugin should implement.
   * @param string $plugin_definition_annotation_name
   *   (optional) Name of the annotation that contains the plugin definition.
   *   Defaults to 'Drupal\Component\Annotation\Plugin'.
   */
  public function __construct(Theme $theme, $subdir, $plugin_interface = NULL, $plugin_definition_annotation_name = 'Drupal\Component\Annotation\Plugin') {
    // Get the active theme.
    $this->theme = $theme;

    // Determine the namespaces to search for.
    $namespaces = [];
    foreach ($theme->getAncestry() as $ancestor) {
      $namespaces['Drupal\\' . $ancestor->getName()] = [DRUPAL_ROOT . '/' . $ancestor->getPath() . '/src'];
    }
    $this->namespaces = new \ArrayObject($namespaces);

    $this->subdir = $subdir;
    $this->pluginDefinitionAnnotationName = $plugin_definition_annotation_name;
    $this->pluginInterface = $plugin_interface;
    $this->themeHandler = \Drupal::service('theme_handler');
    $this->themeManager = \Drupal::service('theme.manager');
  }

  /**
   * {@inheritdoc}
   */
  protected function alterDefinitions(&$definitions) {
    if ($this->alterHook) {
      $this->themeManager->alter($this->alterHook, $definitions);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function createInstance($plugin_id, array $configuration = []) {
    if (!isset($configuration['theme'])) {
      $configuration['theme'] = $this->theme;
    }
    return parent::createInstance($plugin_id, $configuration);
  }

  /**
   * Retrieves the cache tags used to invalidate caches.
   *
   * @return array
   *   An indexed array of cache tags.
   */
  public function getCacheTags() {
    return [Bootstrap::CACHE_TAG];
  }

  /**
   * {@inheritdoc}
   */
  public function getDefinitions($sorted = TRUE) {
    $definitions = parent::getDefinitions();
    if ($sorted) {
      uasort($definitions, ['\Drupal\Component\Utility\SortArray', 'sortByWeightElement']);
    }
    return $definitions;
  }

  /**
   * Retrieves all definitions where the plugin ID matches a certain criteria.
   *
   * @param string $regex
   *   The regex pattern to match.
   *
   * @return array[]
   *   An array of plugin definitions (empty array if no definitions were
   *   found). Keys are plugin IDs.
   */
  public function getDefinitionsLike($regex) {
    $definitions = [];
    foreach ($this->getDefinitions() as $plugin_id => $definition) {
      if (preg_match($regex, $plugin_id)) {
        $definitions[$plugin_id] = $definition;
      }
    }
    ksort($definitions, SORT_NATURAL);
    return $definitions;
  }

  /**
   * {@inheritdoc}
   */
  protected function providerExists($provider) {
    return $this->themeHandler->themeExists($provider);
  }

}
