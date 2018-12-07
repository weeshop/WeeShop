<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Tooltips;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "tooltip_trigger" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "tooltip_trigger",
 *   type = "select",
 *   title = @Translation("trigger"),
 *   description = @Translation("How a tooltip is triggered."),
 *   defaultValue = "hover",
 *   options = {
 *     "click" = @Translation("click"),
 *     "hover" = @Translation("hover"),
 *     "focus" = @Translation("focus"),
 *     "manual" = @Translation("manual"),
 *   },
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "tooltips" = @Translation("Tooltips"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class TooltipTrigger extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('tooltip_enabled');
  }

}
