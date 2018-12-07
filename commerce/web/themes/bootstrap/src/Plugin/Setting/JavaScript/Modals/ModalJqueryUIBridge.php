<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Modals;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "modal_jquery_ui_bridge" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "modal_jquery_ui_bridge",
 *   type = "checkbox",
 *   title = @Translation("jQuery UI Bridge"),
 *   description = @Translation("Enabling this replaces the core/jquery.ui.dialog dependency in the core/drupal.dialog library with a bridge. This bridge adds support to Bootstrap Modals so that it may interpret jQuery UI Dialog functionality. It is highly recommended that this remain enabled unless you know what you're really doing."),
 *   defaultValue = 1,
 *   weight = 0,
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "modals" = @Translation("Modals"),
 *   },
 * )
 */
class ModalJqueryUIBridge extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    parent::alterFormElement($form, $form_state, $form_id);
    $setting = $this->getSettingElement($form, $form_state);
    $setting->setProperty('states', [
      'visible' => [
        ':input[name="modal_enabled"]' => ['checked' => TRUE],
      ],
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return ['rendered', 'library_info'];
  }

}
