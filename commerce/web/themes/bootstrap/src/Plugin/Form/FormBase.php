<?php

namespace Drupal\bootstrap\Plugin\Form;

use Drupal\bootstrap\Plugin\PluginBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Base form alter class.
 *
 * @ingroup plugins_form
 */
class FormBase extends PluginBase implements FormInterface {

  /**
   * {@inheritdoc}
   */
  public function alterForm(array &$form, FormStateInterface $form_state, $form_id = NULL) {
    $this->alterFormElement(Element::create($form), $form_state, $form_id);
  }

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {}

  /**
   * {@inheritdoc}
   */
  public static function submitForm(array &$form, FormStateInterface $form_state) {
    static::submitFormElement(Element::create($form), $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public static function submitFormElement(Element $form, FormStateInterface $form_state) {}

  /**
   * {@inheritdoc}
   */
  public static function validateForm(array &$form, FormStateInterface $form_state) {
    static::validateFormElement(Element::create($form), $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public static function validateFormElement(Element $form, FormStateInterface $form_state) {}

}
