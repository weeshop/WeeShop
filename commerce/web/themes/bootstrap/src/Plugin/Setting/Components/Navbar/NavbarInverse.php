<?php

namespace Drupal\bootstrap\Plugin\Setting\Components\Navbar;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "navbar_inverse" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "navbar_inverse",
 *   type = "checkbox",
 *   title = @Translation("Inverse navbar style"),
 *   description = @Translation("Select if you want the inverse navbar style."),
 *   defaultValue = 0,
 *   groups = {
 *     "components" = @Translation("Components"),
 *     "navbar" = @Translation("Navbar"),
 *   },
 * )
 */
class NavbarInverse extends SettingBase {}
