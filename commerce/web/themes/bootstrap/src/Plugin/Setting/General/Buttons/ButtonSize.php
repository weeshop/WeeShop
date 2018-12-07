<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Buttons;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "button_size" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "button_size",
 *   type = "select",
 *   title = @Translation("Default button size"),
 *   defaultValue = "",
 *   description = @Translation("Defines the Bootstrap Buttons specific size"),
 *   empty_option = @Translation("Normal"),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "button" = @Translation("Buttons"),
 *   },
 *   options = {
 *     "btn-xs" = @Translation("Extra Small"),
 *     "btn-sm" = @Translation("Small"),
 *     "btn-lg" = @Translation("Large"),
 *   },
 * )
 */
class ButtonSize extends SettingBase {}
