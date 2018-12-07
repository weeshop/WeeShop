<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Tooltips;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "tooltip_placement" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "tooltip_placement",
 *   type = "select",
 *   title = @Translation("placement"),
 *   description = @Translation("Where to position the tooltip. When <code>auto</code> is specified, it will dynamically reorient the tooltip. For example, if placement is <code>auto left</code>, the tooltip will display to the left when possible, otherwise it will display right."),
 *   defaultValue = "auto left",
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
 *     "tooltips" = @Translation("Tooltips"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class TooltipPlacement extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('tooltip_enabled');
  }

}
