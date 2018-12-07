<?php

namespace Drupal\bootstrap\Plugin\Form;

use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the interface for an object oriented form alter.
 *
 * @ingroup plugins_form
 */
interface FormInterface {

  /**
   * The alter method to store the code.
   *
   * @param array $form
   *   Nested array of form elements that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param string $form_id
   *   String representing the name of the form itself. Typically this is the
   *   name of the function that generated the form.
   */
  public function alterForm(array &$form, FormStateInterface $form_state, $form_id = NULL);

  /**
   * The alter method to store the code.
   *
   * @param \Drupal\bootstrap\Utility\Element $form
   *   The Element object that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param string $form_id
   *   String representing the name of the form itself. Typically this is the
   *   name of the function that generated the form.
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL);

  /**
   * Form validation handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public static function validateForm(array &$form, FormStateInterface $form_state);

  /**
   * Form validation handler.
   *
   * @param \Drupal\bootstrap\Utility\Element $form
   *   The Element object that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public static function validateFormElement(Element $form, FormStateInterface $form_state);

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public static function submitForm(array &$form, FormStateInterface $form_state);

  /**
   * Form submission handler.
   *
   * @param \Drupal\bootstrap\Utility\Element $form
   *   The Element object that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public static function submitFormElement(Element $form, FormStateInterface $form_state);

}
