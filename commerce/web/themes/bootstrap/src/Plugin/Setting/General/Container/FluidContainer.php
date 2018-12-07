<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Container;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * Container theme settings.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "fluid_container",
 *   type = "checkbox",
 *   title = @Translation("Fluid container"),
 *   defaultValue = 0,
 *   description = @Translation("Uses the <code>.container-fluid</code> class instead of <code>.container</code>."),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "container" = @Translation("Container"),
 *   },
 *   see = {
 *     "https://getbootstrap.com/docs/3.3/css/#grid-example-fluid" = @Translation("Fluid container"),
 *   },
 * )
 */
class FluidContainer extends SettingBase {}
