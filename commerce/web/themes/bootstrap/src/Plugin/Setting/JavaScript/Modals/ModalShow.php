<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Modals;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "modal_show" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "modal_show",
 *   type = "checkbox",
 *   title = @Translation("show"),
 *   description = @Translation("Shows the modal when initialized."),
 *   defaultValue = 1,
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "modals" = @Translation("Modals"),
 *     "options" = @Translation("Options"),
 *   },
 * )
 */
class ModalShow extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('modal_enabled');
  }

}
