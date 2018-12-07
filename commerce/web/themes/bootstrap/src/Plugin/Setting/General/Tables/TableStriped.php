<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Tables;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "table_striped" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "table_striped",
 *   type = "checkbox",
 *   title = @Translation("Striped rows"),
 *   description = @Translation("Add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>."),
 *   defaultValue = 1,
 *   groups = {
 *     "general" = @Translation("General"),
 *     "tables" = @Translation("Tables"),
 *   },
 * )
 */
class TableStriped extends SettingBase {}
