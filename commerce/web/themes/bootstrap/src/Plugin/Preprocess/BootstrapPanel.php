<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Component\Render\MarkupInterface;
use Drupal\Component\Utility\Html;

/**
 * Pre-processes variables for the "bootstrap_panel" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("bootstrap_panel")
 */
class BootstrapPanel extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  protected function preprocessElement(Element $element, Variables $variables) {
    // Assign the ID, if not already set.
    $element->map(['id']);

    // Add necessary classes.
    $element->addClass([
      'form-item',
      'js-form-item',
      'form-wrapper',
      'js-form-wrapper',
    ]);

    $body = [];
    $properties = ['field_prefix', 'body', 'children'];

    // Only add the #value property if it's a "details" or "fieldset" element
    // type. Some form elements may use "CompositeFormElementTrait" which
    // will inadvertently and eventually become preprocessed here and #value
    // may actually be the element's value instead of a renderable element.
    if ($element->isType(['details', 'fieldset'])) {
      $properties[] = 'value';
    }

    // Add the "#field_suffix" property.
    $properties[] = 'field_suffix';

    // Merge all possible content from the element into a single render array.
    foreach ($properties as $property) {
      $body[$property] = Element::create($element->getProperty($property, []))->getArray();
    }
    $variables['body'] = array_filter($body);

    $map = [
      'attributes' => 'attributes',
      'body_attributes' => 'body_attributes',
      'content_attributes' => 'body_attributes',
      'description' => 'description',
      'description_attributes' => 'description_attributes',
      'description_display' => 'description_display',
      'errors' => 'errors',
      'footer' => 'footer',
      'required' => 'required',
      'panel_type' => 'panel_type',
      'title' => 'heading',
      'title_attributes' => 'heading_attributes',
    ];

    // Handle specific "details" elements.
    if ($element->isType('details')) {
      // Details are always collapsible per the HTML5 spec.
      // @see https://www.drupal.org/node/1852020
      $variables['collapsible'] = TRUE;

      // Determine the collapsed state.
      $variables['collapsed'] = !$element->getProperty('open', TRUE);

      // Remove the unnecessary details attribute.
      $element->removeAttribute('open');
    }
    // Handle specific "fieldset" elements.
    elseif ($element->isType('fieldset')) {
      // Override variables to mimic the default "fieldset" element info.
      // They will be mapped below if they exist on the element.
      unset($variables['collapsible'], $variables['collapsed']);
      $map['collapsed'] = 'collapsed';
      $map['collapsible'] = 'collapsible';
    }

    // Map the element properties to the variables array.
    $variables->map($map);
  }

  /**
   * {@inheritdoc}
   */
  protected function preprocessVariables(Variables $variables) {
    // Retrieve the ID, generating one if needed.
    $id = $variables->getAttribute('id', Html::getUniqueId($variables->offsetGet('id', 'bootstrap-panel')));
    unset($variables['id']);

    // Handle collapsible state.
    if ($variables['heading'] && $variables['collapsible']) {
      // Retrieve the body ID attribute.
      if ($body_id = $variables->getAttribute('id', "$id--content", 'body_attributes')) {
        // Ensure the target is set.
        if ($variables['target'] = $variables->offsetGet('target', "#$body_id")) {
          // Set additional necessary attributes to the heading.
          $variables->setAttributes([
            'aria-controls' => preg_replace('/^#/', '', $variables['target']),
            'aria-expanded' => !$variables['collapsed'] ? 'true' : 'false',
            'aria-pressed' => !$variables['collapsed'] ? 'true' : 'false',
            'data-toggle' => 'collapse',
            'role' => 'button',
          ], 'heading_attributes');
        }
      }
    }

    // Ensure we render HTML from heading.
    $heading = $variables->offsetGet('heading');
    if ($heading && (is_string($heading) || ($heading instanceof MarkupInterface))) {
      $variables->offsetSet('heading', ['#markup' => $heading]);
    }

    // Ensure there is a valid panel state.
    if (!$variables->offsetGet('panel_type')) {
      $variables->offsetSet('panel_type', 'default');
    }

    // Convert the description variable.
    $this->preprocessDescription();

    // Ensure all attributes are proper objects.
    $this->preprocessAttributes();
  }

}
