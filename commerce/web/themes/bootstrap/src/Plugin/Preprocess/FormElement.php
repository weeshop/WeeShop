<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "form_element" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("form_element")
 */
class FormElement extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessElement(Element $element, Variables $variables) {
    // Set has_error flag.
    $variables['has_error'] = $element->getProperty('has_error');

    if ($element->getProperty('autocomplete_route_name')) {
      $variables['is_autocomplete'] = TRUE;
    }

    // See https://getbootstrap.com/docs/3.3/css/#forms-controls.
    $checkbox = $variables['is_checkbox'] = $element->isType('checkbox');
    $radio = $variables['is_radio'] = $element->isType('radio');

    // Determine if the form element should have the "form-group" class added.
    // Use an explicitly set property from the element or use its other
    // properties as the criteria to determine if it should be set.
    $variables['is_form_group'] = $element->getProperty('form_group', !$checkbox && !$radio && !$element->isType('hidden'));

    // Add label_display and label variables to template.
    $display = $variables['label_display'] = $variables['title_display'] = $element->getProperty('title_display');

    // Place single checkboxes and radios in the label field.
    if (($checkbox || $radio)) {
      $label = Element::create($variables['label']);
      $children = &$label->getProperty('children', '');
      $children .= $variables['children'];
      if ($label->getProperty('title_display') != 'none') {
        unset($variables['children']);
      }

      // Inform label if it is in checkbox/radio context.
      $label->setProperty('is_checkbox', $checkbox);
      $label->setProperty('is_radio', $radio);

      // Pass the label attributes to the label, if available.
      if ($element->hasProperty('label_attributes')) {
        $label->setAttributes($element->getProperty('label_attributes'));
      }
    }

    // Remove the #field_prefix and #field_suffix values set in
    // template_preprocess_form_element(). These are handled at the input level.
    // @see \Drupal\bootstrap\Plugin\Preprocess\Input::preprocess().
    unset($variables['prefix']);
    unset($variables['suffix']);
  }

}
