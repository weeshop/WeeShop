<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Modals;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "modal_enabled" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "modal_enabled",
 *   type = "checkbox",
 *   title = @Translation("Enable Bootstrap Modals"),
 *   defaultValue = 1,
 *   weight = -1,
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "modals" = @Translation("Modals"),
 *   },
 * )
 */
class ModalEnabled extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    parent::alterFormElement($form, $form_state, $form_id);
    $group = $this->getGroupElement($form, $form_state);
    $group->setProperty('description', t('Modals are streamlined, but flexible, dialog prompts with the minimum required functionality and smart defaults. See <a href=":url" target="_blank">Bootstrap Modals</a> for more documentation.', [
      ':url' => 'https://getbootstrap.com/docs/3.3/javascript/#modals',
    ]));
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return ['rendered', 'library_info'];
  }

}
