<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Popovers;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "popover_trigger" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "popover_trigger",
 *   type = "select",
 *   title = @Translation("trigger"),
 *   description = @Translation("How a popover is triggered."),
 *   defaultValue = "click",
 *   options = {
 *     "click" = @Translation("click"),
 *     "hover" = @Translation("hover"),
 *     "focus" = @Translation("focus"),
 *     "manual" = @Translation("manual"),
 *   },
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "popovers" = @Translation("Popovers"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class PopoverTrigger extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('popover_enabled');
  }

}
