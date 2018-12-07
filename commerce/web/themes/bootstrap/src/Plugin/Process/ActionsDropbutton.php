<?php

namespace Drupal\bootstrap\Plugin\Process;

use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Replaces the process callback for dropbuttons on an "actions" element.
 *
 * @ingroup plugins_process
 *
 * @BootstrapProcess("actions__dropbutton",
 *   replace = "Drupal\Core\Render\Element\Actions::preRenderActionsDropbutton",
 * )
 *
 * @see \Drupal\Core\Render\Element\Actions::preRenderActionsDropbutton()
 *
 * @see https://www.drupal.org/node/2855458
 *
 * @todo Remove once core is fixed.
 */
class ActionsDropbutton extends ProcessBase implements ProcessInterface {

  /**
   * {@inheritdoc}
   */
  public static function processElement(Element $element, FormStateInterface $form_state, array &$complete_form) {
    $dropbuttons = Element::create();
    foreach ($element->children(TRUE) as $key => $child) {
      if ($dropbutton = $child->getProperty('dropbutton')) {
        // If there is no dropbutton for this button group yet, create one.
        if (!isset($dropbuttons->$dropbutton)) {
          $dropbuttons->$dropbutton = ['#type' => 'dropbutton'];
        }

        $dropbuttons[$dropbutton]['#links'][$key] = ['title' => $child->getArray()];

        // Remove original child from the element so it's not rendered twice.
        $child->setProperty('printed', TRUE);
      }
    }
    $element->exchangeArray($dropbuttons->getArray() + $element->getArray());
  }

}
