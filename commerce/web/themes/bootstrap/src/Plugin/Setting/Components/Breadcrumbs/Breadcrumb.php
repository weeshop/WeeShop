<?php

namespace Drupal\bootstrap\Plugin\Setting\Components\Breadcrumbs;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "breadcrumb" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "breadcrumb",
 *   type = "select",
 *   title = @Translation("Breadcrumb visibility"),
 *   description = @Translation("Show or hide the Breadcrumbs"),
 *   defaultValue = "1",
 *   groups = {
 *     "components" = @Translation("Components"),
 *     "breadcrumbs" = @Translation("Breadcrumbs"),
 *   },
 *   options = {
 *     0 = @Translation("Hidden"),
 *     1 = @Translation("Visible"),
 *     2 = @Translation("Only in admin areas"),
 *   },
 * )
 */
class Breadcrumb extends SettingBase {}
