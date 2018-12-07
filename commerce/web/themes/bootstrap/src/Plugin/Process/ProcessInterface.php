<?php

namespace Drupal\bootstrap\Plugin\Process;

use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the interface for an object oriented process plugin.
 *
 * @ingroup plugins_process
 */
interface ProcessInterface {

  /**
   * Process a specific form element type.
   *
   * Implementations of this method should check to see if the element has a
   * property named #bootstrap_ignore_process and check if it is set to TRUE.
   * If it is, the method should immediately return with the unaltered element.
   *
   * @param array $element
   *   The element render array.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param array $complete_form
   *   The complete form structure.
   *
   * @return array
   *   The altered element array.
   *
   * @see \Drupal\bootstrap\Plugin\Alter\ElementInfo::alter
   */
  public static function process(array $element, FormStateInterface $form_state, array &$complete_form);

}
