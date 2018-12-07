<?php

namespace Drupal\bootstrap\Plugin\Setting\Components\Region;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "region_wells" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "region_wells",
 *   type = "container",
 *   description = @Translation("Enable the <code>.well</code>, <code>.well-sm</code> or <code>.well-lg</code> classes for specified regions."),
 *   defaultValue = {
 *     "navigation" = "",
 *     "navigation_collapsible" = "",
 *     "header" = "",
 *     "highlighted" = "",
 *     "help" = "",
 *     "content" = "",
 *     "sidebar_first" = "",
 *     "sidebar_second" = "well",
 *     "footer" = "",
 *   },
 *   groups = {
 *     "components" = @Translation("Components"),
 *     "region_wells" = @Translation("Region Wells"),
 *   },
 *   see = {
 *     "https://getbootstrap.com/docs/3.3/components/#wells" = @Translation("Bootstrap Wells"),
 *   },
 * )
 */
class RegionWells extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    parent::alterFormElement($form, $form_state, $form_id);

    $group = $this->getGroupElement($form, $form_state);
    $setting = $this->getSettingElement($form, $form_state);

    // Move description.
    $group->setProperty('description', $setting->getProperty('description'));

    // Retrieve the current default values.
    $default_values = $setting->getProperty('default_value', $this->getDefaultValue());

    $wells = [
      '' => t('None'),
      'well' => t('.well (normal)'),
      'well well-sm' => t('.well-sm (small)'),
      'well well-lg' => t('.well-lg (large)'),
    ];
    // Create dynamic well settings for each region.
    $regions = system_region_list($this->theme->getName());
    foreach ($regions as $name => $title) {
      if (in_array($name, ['page_top', 'page_bottom'])) {
        continue;
      }
      $setting->{'region_well-' . $name} = [
        '#title' => $title,
        '#type' => 'select',
        '#attributes' => [
          'class' => ['input-sm'],
        ],
        '#options' => $wells,
        '#default_value' => isset($default_values[$name]) ? $default_values[$name] : '',
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function submitFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    $values = $form_state->getValues();

    // Extract the regions from individual dynamic settings.
    $regex = '/^region_well-/';
    $region_wells = [];
    foreach ($values as $key => $value) {
      if (!preg_match($regex, $key)) {
        continue;
      }
      $region_wells[preg_replace($regex, '', $key)] = $value;
      unset($values[$key]);
    }

    // Store the new values.
    $values['region_wells'] = $region_wells;
    $form_state->setValues($values);
  }

}
