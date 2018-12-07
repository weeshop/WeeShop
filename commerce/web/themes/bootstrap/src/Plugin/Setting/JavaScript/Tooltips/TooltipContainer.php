<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Tooltips;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "tooltip_container" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "tooltip_container",
 *   type = "textfield",
 *   title = @Translation("container"),
 *   description = @Translation("Appends the tooltip to a specific element. Example: <code>body</code>."),
 *   defaultValue = "body",
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "tooltips" = @Translation("Tooltips"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class TooltipContainer extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('tooltip_enabled');
  }

}
