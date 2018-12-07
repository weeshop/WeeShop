<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Forms;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "forms_smart_descriptions" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "forms_smart_descriptions",
 *   type = "checkbox",
 *   title = @Translation("Smart form descriptions (via Tooltips)"),
 *   defaultValue = 1,
 *   description = @Translation("Convert descriptions into tooltips (must be enabled) automatically based on certain criteria. This helps reduce the, sometimes unnecessary, amount of noise on a page full of form elements."),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "forms" = @Translation("Forms"),
 *   },
 * )
 */
class FormsSmartDescriptions extends SettingBase {}
