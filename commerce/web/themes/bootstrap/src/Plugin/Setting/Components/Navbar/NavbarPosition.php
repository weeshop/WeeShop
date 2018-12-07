<?php

namespace Drupal\bootstrap\Plugin\Setting\Components\Navbar;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "navbar_position" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "navbar_position",
 *   type = "select",
 *   title = @Translation("Navbar Position"),
 *   description = @Translation("Determines where the navbar is positioned on the page."),
 *   defaultValue = "",
 *   groups = {
 *     "components" = @Translation("Components"),
 *     "navbar" = @Translation("Navbar"),
 *   },
 *   empty_option = @Translation("Normal"),
 *   options = {
 *     "static-top" = @Translation("Static Top"),
 *     "fixed-top" = @Translation("Fixed Top"),
 *     "fixed-bottom" = @Translation("Fixed Bottom"),
 *   },
 * )
 */
class NavbarPosition extends SettingBase {}
