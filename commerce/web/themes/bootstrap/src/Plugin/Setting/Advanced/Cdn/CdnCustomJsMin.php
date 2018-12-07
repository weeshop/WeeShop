<?php

namespace Drupal\bootstrap\Plugin\Setting\Advanced\Cdn;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "cdn_custom_js_min" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   cdn_provider = "custom",
 *   id = "cdn_custom_js_min",
 *   type = "textfield",
 *   weight = 4,
 *   title = @Translation("Minified Bootstrap JavaScript URL"),
 *   defaultValue = "https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js",
 *   description = @Translation("Additionally, you can provide the minimized version of the file. It will be used instead if site aggregation is enabled."),
 *   groups = {
 *     "advanced" = @Translation("Advanced"),
 *     "cdn" = @Translation("CDN (Content Delivery Network)"),
 *     "custom" = false,
 *   },
 * )
 */
class CdnCustomJsMin extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return ['library_info'];
  }

}
