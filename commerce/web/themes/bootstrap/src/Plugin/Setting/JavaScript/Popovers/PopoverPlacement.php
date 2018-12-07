<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Popovers;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "popover_placement" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "popover_placement",
 *   type = "select",
 *   title = @Translation("placement"),
 *   description = @Translation("Where to position the popover. When <code>auto</code> is specified, it will dynamically reorient the popover. For example, if placement is <code>auto left</code>, the popover will display to the left when possible, otherwise it will display right."),
 *   defaultValue = "right",
 *   options = {
 *     "top" = @Translation("top"),
 *     "bottom" = @Translation("bottom"),
 *     "left" = @Translation("left"),
 *     "right" = @Translation("right"),
 *     "auto" = @Translation("auto"),
 *     "auto top" = @Translation("auto top"),
 *     "auto bottom" = @Translation("auto bottom"),
 *     "auto left" = @Translation("auto left"),
 *     "auto right" = @Translation("auto right"),
 *   },
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "popovers" = @Translation("Popovers"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class PopoverPlacement extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('popover_enabled');
  }

}
