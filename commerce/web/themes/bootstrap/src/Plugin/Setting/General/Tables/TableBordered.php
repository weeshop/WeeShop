<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Tables;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "table_bordered" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "table_bordered",
 *   type = "checkbox",
 *   title = @Translation("Bordered table"),
 *   description = @Translation("Add borders on all sides of the table and cells."),
 *   defaultValue = 0,
 *   groups = {
 *     "general" = @Translation("General"),
 *     "tables" = @Translation("Tables"),
 *   },
 * )
 */
class TableBordered extends SettingBase {}
