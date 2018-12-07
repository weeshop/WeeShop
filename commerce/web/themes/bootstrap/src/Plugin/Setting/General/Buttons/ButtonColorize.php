<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Buttons;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "button_colorize" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "button_colorize",
 *   type = "checkbox",
 *   title = @Translation("Colorize Buttons"),
 *   defaultValue = 1,
 *   description = @Translation("Adds classes to buttons based on their text value."),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "button" = @Translation("Buttons"),
 *   },
 *   see = {
 *     "https://getbootstrap.com/docs/3.3/css/#buttons" = @Translation("Buttons"),
 *     "https://drupal-bootstrap.org/apis/hook_bootstrap_colorize_text_alter" = @Translation("hook_bootstrap_colorize_text_alter()"),
 *   },
 * )
 */
class ButtonColorize extends SettingBase {}
