<?php

namespace Drupal\bootstrap\Plugin\Provider;

/**
 * The "custom" CDN provider plugin.
 *
 * @ingroup plugins_provider
 *
 * @BootstrapProvider(
 *   id = "custom",
 *   label = @Translation("Custom"),
 * )
 */
class Custom extends ProviderBase {

  /**
   * {@inheritdoc}
   */
  public function getAssets($types = NULL) {
    $this->assets = [];

    // If no type is set, return all CSS and JS.
    if (!isset($types)) {
      $types = ['css', 'js'];
    }
    $types = is_array($types) ? $types : [$types];

    foreach ($types as $type) {
      if ($setting = $this->theme->getSetting('cdn_custom_' . $type)) {
        $this->assets[$type][] = $setting;
      }
      if ($setting = $this->theme->getSetting('cdn_custom_' . $type . '_min')) {
        $this->assets['min'][$type][] = $setting;
      }
    }
    return parent::getAssets($types);
  }

}
