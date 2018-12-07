<?php

namespace Drupal\bootstrap\Plugin\Setting\Advanced\Cdn;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "cdn_custom_js" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   cdn_provider = "custom",
 *   id = "cdn_custom_js",
 *   type = "textfield",
 *   weight = 3,
 *   title = @Translation("Bootstrap JavaScript URL"),
 *   defaultValue = "https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.js",
 *   description = @Translation("It is best to use <code>https</code> protocols here as it will allow more flexibility if the need ever arises."),
 *   groups = {
 *     "advanced" = @Translation("Advanced"),
 *     "cdn" = @Translation("CDN (Content Delivery Network)"),
 *     "custom" = false,
 *   },
 * )
 */
class CdnCustomJs extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return ['library_info'];
  }

}
