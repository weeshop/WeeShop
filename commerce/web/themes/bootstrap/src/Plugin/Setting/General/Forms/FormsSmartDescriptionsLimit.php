<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Forms;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "forms_smart_descriptions_limit" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "forms_smart_descriptions_limit",
 *   type = "textfield",
 *   title = @Translation("Smart form descriptions maximum character limit"),
 *   defaultValue = "250",
 *   description = @Translation("Prevents descriptions from becoming tooltips by checking the character length of the description (HTML is not counted towards this limit). To disable this filtering criteria, leave an empty value."),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "forms" = @Translation("Forms"),
 *   },
 * )
 */
class FormsSmartDescriptionsLimit extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    $setting = $this->getSettingElement($form, $form_state);
    $setting->setProperty('states', [
      'visible' => [
        ':input[name="forms_smart_descriptions"]' => ['checked' => TRUE],
      ],
    ]);
  }

}
