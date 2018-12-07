<?php

namespace Drupal\bootstrap\Plugin\Provider;

use Drupal\Component\Plugin\DerivativeInspectionInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * ProviderInterface.
 *
 * @ingroup plugins_provider
 */
interface ProviderInterface extends PluginInspectionInterface, DerivativeInspectionInterface {

  /**
   * Retrieves the API URL if set.
   *
   * @return string
   *   The API URL.
   */
  public function getApi();

  /**
   * Retrieves Provider assets for the active provider, if any.
   *
   * @param string|array $types
   *   The type of asset to retrieve: "css" or "js", defaults to an array
   *   array containing both if not set.
   *
   * @return array
   *   If $type is a string or an array with only one (1) item in it, the
   *   assets are returned as an indexed array of files. Otherwise, an
   *   associative array is returned keyed by the type.
   */
  public function getAssets($types = NULL);

  /**
   * Retrieves the provider description.
   *
   * @return string
   *   The provider description.
   */
  public function getDescription();

  /**
   * Retrieves the provider human-readable label.
   *
   * @return string
   *   The provider human-readable label.
   */
  public function getLabel();

  /**
   * Retrieves the themes supported by the CDN provider.
   *
   * @return array
   *   An array of themes. If the CDN provider does not support any it will
   *   just be an empty array.
   */
  public function getThemes();

  /**
   * Retrieves the versions supported by the CDN provider.
   *
   * @return array
   *   An array of versions. If the CDN provider does not support any it will
   *   just be an empty array.
   */
  public function getVersions();

  /**
   * Flag indicating that the API data parsing failed.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function hasError();

  /**
   * Flag indicating that the API data was manually imported.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function isImported();

  /**
   * Processes the provider plugin definition upon discovery.
   *
   * @param array $definition
   *   The provider plugin definition.
   * @param string $plugin_id
   *   The plugin identifier.
   */
  public function processDefinition(array &$definition, $plugin_id);

  /**
   * Processes the provider plugin definition upon discovery.
   *
   * @param array $json
   *   The JSON data retrieved from the API request.
   * @param array $definition
   *   The provider plugin definition.
   */
  public function processApi(array $json, array &$definition);

}
