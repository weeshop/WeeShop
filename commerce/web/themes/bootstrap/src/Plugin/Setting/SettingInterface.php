<?php

namespace Drupal\bootstrap\Plugin\Setting;

use Drupal\bootstrap\Plugin\Form\FormInterface;
use Drupal\bootstrap\Utility\Element;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the interface for an object oriented theme setting plugin.
 *
 * @ingroup plugins_setting
 */
interface SettingInterface extends PluginInspectionInterface, FormInterface {

  /**
   * Determines whether a theme setting should added to drupalSettings.
   *
   * By default, this value will be FALSE unless the method is overridden. This
   * is to ensure that no sensitive information can be potientially leaked.
   *
   * @see \Drupal\bootstrap\Plugin\Setting\SettingBase::drupalSettings()
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function drupalSettings();

  /**
   * The cache tags associated with this object.
   *
   * When this object is modified, these cache tags will be invalidated.
   *
   * @return string[]
   *   A set of cache tags.
   */
  public function getCacheTags();

  /**
   * Retrieves the setting's default value.
   *
   * @return string
   *   The setting's default value.
   */
  public function getDefaultValue();

  /**
   * Retrieves the group form element the setting belongs to.
   *
   * @param array $form
   *   Nested array of form elements that comprise the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\bootstrap\Utility\Element
   *   The group element object.
   *
   * @deprecated Will be removed in a future release. Use \Drupal\bootstrap\Plugin\Setting\SettingInterface::getGroupElement
   */
  public function getGroup(array &$form, FormStateInterface $form_state);

  /**
   * Retrieves the group form element the setting belongs to.
   *
   * @param \Drupal\bootstrap\Utility\Element $form
   *   The Element object that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\bootstrap\Utility\Element
   *   The group element object.
   */
  public function getGroupElement(Element $form, FormStateInterface $form_state);

  /**
   * Retrieves the setting's groups.
   *
   * @return array
   *   The setting's group.
   */
  public function getGroups();

  /**
   * Retrieves the form element for the setting.
   *
   * @param array $form
   *   Nested array of form elements that comprise the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\bootstrap\Utility\Element
   *   The setting element object.
   *
   * @deprecated Will be removed in a future release. Use \Drupal\bootstrap\Plugin\Setting\SettingInterface::getSettingElement
   */
  public function getElement(array &$form, FormStateInterface $form_state);

  /**
   * Retrieves the settings options, if set.
   *
   * @return array
   *   An array of options.
   */
  public function getOptions();

  /**
   * Retrieves the form element for the setting.
   *
   * @param \Drupal\bootstrap\Utility\Element $form
   *   The Element object that comprises the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\bootstrap\Utility\Element
   *   The setting element object.
   */
  public function getSettingElement(Element $form, FormStateInterface $form_state);

  /**
   * Retrieves the setting's human-readable title.
   *
   * @return string
   *   The setting's type.
   */
  public function getTitle();

}
