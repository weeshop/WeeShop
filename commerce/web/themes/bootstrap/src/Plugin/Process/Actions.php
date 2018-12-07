<?php

namespace Drupal\bootstrap\Plugin\Process;

use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Processes the "actions" element.
 *
 * @ingroup plugins_process
 *
 * @BootstrapProcess("actions")
 */
class Actions extends ProcessBase implements ProcessInterface {

  /**
   * {@inheritdoc}
   */
  public static function processElement(Element $element, FormStateInterface $form_state, array &$complete_form) {
    foreach ($element->children() as $child) {
      if ($child->isPropertyEmpty('icon')) {
        $child->setIcon();
      }
    }
  }

}
