<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Tables;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "table_responsive" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "table_responsive",
 *   type = "select",
 *   title = @Translation("Responsive tables"),
 *   description = @Translation("Wraps tables with <code>.table-responsive</code> to make them horizontally scroll when viewing them on devices under 768px. When viewing on devices larger than 768px, you will not see a difference in the presentational aspect of these tables. The <code>Automatic</code> option will only apply this setting for front-end facing tables, not the tables in administrative areas."),
 *   defaultValue = -1,
 *   weight = 1,
 *   groups = {
 *     "general" = @Translation("General"),
 *     "tables" = @Translation("Tables"),
 *   },
 *   options = {
 *     "-1" = @Translation("Automatic"),
 *     "0" = @Translation("Disabled"),
 *     "1" = @Translation("Enabled"),
 *   },
 * )
 */
class TableResponsive extends SettingBase {}
