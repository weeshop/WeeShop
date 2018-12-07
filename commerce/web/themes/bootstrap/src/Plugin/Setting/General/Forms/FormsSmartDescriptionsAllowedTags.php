<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Forms;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "forms_smart_descriptions_allowed_tags" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "forms_smart_descriptions_allowed_tags",
 *   type = "textfield",
 *   title = @Translation("Smart form descriptions allowed (HTML) tags"),
 *   defaultValue = "b, code, em, i, kbd, span, strong",
 *   description = @Translation("Prevents descriptions from becoming tooltips by checking for HTML not in the list above (i.e. links). Separate by commas. To disable this filtering criteria, leave an empty value."),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "forms" = @Translation("Forms"),
 *   },
 * )
 */
class FormsSmartDescriptionsAllowedTags extends SettingBase {

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
