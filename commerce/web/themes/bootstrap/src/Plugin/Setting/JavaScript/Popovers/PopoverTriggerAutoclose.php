<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Popovers;

use Drupal\bootstrap\Plugin\Setting\DeprecatedSettingInterface;

/**
 * The "popover_trigger_autoclose" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "popover_trigger_autoclose",
 *   type = "checkbox",
 *   title = @Translation("Auto-close on document click"),
 *   description = @Translation("Will automatically close the current popover if a click occurs anywhere else other than the popover element."),
 *   defaultValue = 1,
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "popovers" = @Translation("Popovers"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 *
 * @deprecated Since 8.x-3.14. Will be removed in a future release.
 *
 * @see \Drupal\bootstrap\Plugin\Setting\JavaScript\Popovers\PopoverAutoClose
 */
class PopoverTriggerAutoclose extends PopoverAutoClose implements DeprecatedSettingInterface {
}
