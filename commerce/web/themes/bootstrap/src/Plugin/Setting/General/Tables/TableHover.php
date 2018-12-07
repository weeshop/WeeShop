<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Tables;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "table_hover" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "table_hover",
 *   type = "checkbox",
 *   title = @Translation("Hover rows"),
 *   description = @Translation("Enable a hover state on table rows."),
 *   defaultValue = 1,
 *   groups = {
 *     "general" = @Translation("General"),
 *     "tables" = @Translation("Tables"),
 *   },
 * )
 */
class TableHover extends SettingBase {}
