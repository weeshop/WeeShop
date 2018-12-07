<?php

namespace Drupal\bootstrap\Plugin\Alter;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Plugin\PluginBase;
use Drupal\bootstrap\Utility\Unicode;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Core\Entity\EntityInterface;

/**
 * Implements hook_theme_suggestions_alter().
 *
 * @ingroup plugins_alter
 *
 * @BootstrapAlter("theme_suggestions")
 */
class ThemeSuggestions extends PluginBase implements AlterInterface {

  /**
   * The element types that should be converted into Panel markup.
   *
   * @var array
   */
  protected $bootstrapPanelTypes = ['details', 'fieldset'];

  /**
   * An element object provided in the variables array, may not be set.
   *
   * @var \Drupal\bootstrap\Utility\Element|false
   */
  protected $element;

  /**
   * The theme hook invoked.
   *
   * @var string
   */
  protected $hook;

  /**
   * The theme hook suggestions, exploded by the "__" delimiter.
   *
   * @var array
   */
  protected $hookSuggestions;

  /**
   * The types of elements to ignore for the "input__form_control" suggestion.
   *
   * @var array
   */
  protected $ignoreFormControlTypes = ['checkbox', 'hidden', 'radio'];

  /**
   * The original "hook" value passed via hook_theme_suggestions_alter().
   *
   * @var string
   */
  protected $originalHook;

  /**
   * The array of suggestions to return.
   *
   * @var array
   */
  protected $suggestions;

  /**
   * The variables array object passed via hook_theme_suggestions_alter().
   *
   * @var \Drupal\bootstrap\Utility\Variables
   */
  protected $variables;

  /**
   * {@inheritdoc}
   */
  public function alter(&$suggestions, &$variables = [], &$hook = NULL) {
    // This is intentionally backwards. The "original" theme hook is actually
    // the hook being invoked. The provided $hook (to the alter) is the watered
    // down version of said original hook.
    $this->hook = !empty($variables['theme_hook_original']) ? $variables['theme_hook_original'] : $hook;
    $this->hookSuggestions = explode('__', $this->hook);
    $this->originalHook = $hook;
    $this->suggestions = $suggestions;
    $this->variables = Variables::create($variables);
    $this->element = $this->variables->element;

    // Processes the necessary theme hook suggestions.
    $this->processSuggestions();

    // Ensure the list of suggestions is unique.
    $suggestions = array_unique($this->suggestions);
  }

  /***************************************************************************
   * Dynamic alter methods.
   ***************************************************************************/

  /**
   * Dynamic alter method for "input".
   */
  protected function alterInput() {
    if ($this->element && $this->element->isButton()) {
      $hook = 'input__button';
      if ($this->element->getProperty('split')) {
        $hook .= '__split';
      }
      $this->addSuggestion($hook);
    }
    elseif ($this->element && !$this->element->isType($this->ignoreFormControlTypes)) {
      $this->addSuggestion('input__form_control');
    }
  }

  /**
   * Dynamic alter method for "links__dropbutton".
   */
  protected function alterLinksDropbutton() {
    // Remove the 'dropbutton' suggestion.
    array_shift($this->hookSuggestions);

    $this->addSuggestion('bootstrap_dropdown');
  }

  /**
   * Dynamic alter method for "user".
   *
   * @see https://www.drupal.org/node/2828634
   * @see https://www.drupal.org/node/2808481
   * @todo Remove/refactor once core issue is resolved.
   */
  protected function alterUser() {
    $this->addSuggestionsForEntity('user');
  }

  /***************************************************************************
   * Protected methods.
   ***************************************************************************/

  /**
   * Adds suggestions based on an array of hooks.
   *
   * @param string|string[] $hook
   *   A single theme hook suggestion or an array of theme hook suggestions.
   */
  protected function addSuggestion($hook) {
    $hooks = (array) $hook;
    foreach ($hooks as $hook) {
      $suggestions = $this->buildSuggestions($hook);
      foreach ($suggestions as $suggestion) {
        $this->suggestions[] = $suggestion;
      }
    }
  }

  /**
   * Adds "bundle" and "view mode" suggestions for an entity.
   *
   * This is a helper method because core's implementation of theme hook
   * suggestions on entities is inconsistent.
   *
   * @param string $entity_type
   *   Optional. A specific type of entity to look for.
   * @param string $prefix
   *   Optional. A prefix (like "entity") to use. It will automatically be
   *   appended with the "__" separator.
   *
   * @see https://www.drupal.org/node/2808481
   *
   * @todo Remove/refactor once core issue is resolved.
   */
  protected function addSuggestionsForEntity($entity_type = 'entity', $prefix = '') {
    // Immediately return if there is no element.
    if (!$this->element) {
      return;
    }

    // Extract the entity.
    if ($entity = $this->getEntityObject($entity_type)) {
      $entity_type_id = $entity->getEntityTypeId();
      $suggestions = [];

      // Only add the entity type identifier if there's a prefix.
      if (!empty($prefix)) {
        $prefix .= '__';
        $suggestions[] = $prefix . '__' . $entity_type_id;
      }

      // View mode.
      if ($view_mode = preg_replace('/[^A-Za-z0-9]+/', '_', $this->element->getProperty('view_mode'))) {
        $suggestions[] = $prefix . $entity_type_id . '__' . $view_mode;

        // Bundle.
        if ($entity->getEntityType()->hasKey('bundle')) {
          $suggestions[] = $prefix . $entity_type_id . '__' . $entity->bundle();
          $suggestions[] = $prefix . $entity_type_id . '__' . $entity->bundle() . '__' . $view_mode;
        }
      }

      // Add suggestions.
      if ($suggestions) {
        $this->addSuggestion($suggestions);
      }
    }
  }

  /**
   * Builds a list of suggestions.
   *
   * @param string $hook
   *   The theme hook suggestion to build.
   *
   * @return array
   *   An list of theme hook suggestions.
   */
  protected function buildSuggestions($hook) {
    $suggestions = [];

    $hook_suggestions = $this->hookSuggestions;

    // Replace the first hook suggestion with $hook.
    array_shift($hook_suggestions);
    array_unshift($suggestions, $hook);

    $suggestions = [];
    while ($hook_suggestions) {
      $suggestions[] = $hook . '__' . implode('__', $hook_suggestions);
      array_pop($hook_suggestions);
    }

    // Append the base hook.
    $suggestions[] = $hook;

    // Return the suggestions, reversed.
    return array_reverse($suggestions);
  }

  /**
   * Retrieves the methods to invoke to process the theme hook suggestion.
   *
   * @return array
   *   An indexed array of methods to be invoked.
   */
  protected function getAlterMethods() {
    // Retrieve cached theme hook suggestion alter methods.
    $cache = $this->theme->getCache('theme_hook_suggestions');
    if ($cache->has($this->hook)) {
      return $cache->get($this->hook);
    }

    // Convert snake_cased hook suggestions into lowerCamelCase alter methods.
    $methods = [];
    $hook_suggestions = array_map('\Drupal\Component\Utility\Unicode::ucfirst', $this->hookSuggestions);
    while ($hook_suggestions) {
      // In order to provide backwards compatibility with sub-themes that used
      // the previous malformed method names, both of the method names need to
      // be checked.
      // @see https://www.drupal.org/project/bootstrap/issues/3008004
      // @todo Only use the last method name and remove array in 8.x-4.x.
      $methodNames = [
        'alter' . implode('', $hook_suggestions),
        'alter' . implode('', array_map('\Drupal\Component\Utility\Unicode::ucfirst', explode('_', implode('', $hook_suggestions)))),
      ];
      foreach (array_unique($methodNames) as $method) {
        if (method_exists($this, $method)) {
          $methods[] = $method;
        }
      }
      array_pop($hook_suggestions);
    }

    // Reverse the methods.
    $methods = array_reverse($methods);

    // Cache the methods.
    $cache->set($this->hook, $methods);

    return $methods;
  }

  /**
   * Extracts the entity from the element(s) passed in the Variables object.
   *
   * @param string $entity_type
   *   Optional. The entity type to attempt to retrieve.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The extracted entity, NULL if entity could not be found.
   */
  protected function getEntityObject($entity_type = 'entity') {
    // Immediately return if there is no element.
    if (!$this->element) {
      return NULL;
    }

    // Attempt to retrieve the provided element type.
    $entity = $this->element->getProperty($entity_type);

    // If the provided entity type doesn't exist, check to see if a generic
    // "entity" property was used instead.
    if ($entity_type !== 'entity' && (!$entity || !($entity instanceof EntityInterface))) {
      $entity = $this->element->getProperty('entity');
    }

    // Only return the entity if it's the proper object.
    return $entity instanceof EntityInterface ? $entity : NULL;
  }

  /**
   * Processes the necessary theme hook suggestions.
   */
  protected function processSuggestions() {
    // Add special hook suggestions for Bootstrap panels.
    if ((in_array($this->originalHook, $this->bootstrapPanelTypes)) && $this->element && $this->element->getProperty('bootstrap_panel', TRUE)) {
      $this->addSuggestion('bootstrap_panel');
    }

    // Retrieve any dynamic alter methods.
    $methods = $this->getAlterMethods();
    foreach ($methods as $method) {
      $this->$method();
    }
  }

  /***************************************************************************
   * Deprecated methods (DO NOT USE).
   ***************************************************************************/

  /**
   * Adds "bundle" and "view mode" suggestions for an entity.
   *
   * @param array $suggestions
   *   The suggestions array, this is ignored.
   * @param \Drupal\bootstrap\Utility\Variables $variables
   *   The variables object, this is ignored.
   * @param string $entity_type
   *   Optional. A specific type of entity to look for.
   * @param string $prefix
   *   Optional. A prefix (like "entity") to use. It will automatically be
   *   appended with the "__" separator.
   *
   * @deprecated Since 8.x-3.2. Will be removed in a future release.
   *
   * @see \Drupal\bootstrap\Plugin\Alter\ThemeSuggestions::addSuggestionsForEntity
   */
  public function addEntitySuggestions(array &$suggestions, Variables $variables, $entity_type = 'entity', $prefix = '') {
    Bootstrap::deprecated();
    $this->addSuggestionsForEntity($entity_type, $prefix);
  }

  /**
   * Extracts the entity from the element(s) passed in the Variables object.
   *
   * @param \Drupal\bootstrap\Utility\Variables $variables
   *   The Variables object, this is ignored.
   * @param string $entity_type
   *   Optional. The entity type to attempt to retrieve.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   The extracted entity, NULL if entity could not be found.
   *
   * @deprecated Since 8.x-3.2. Will be removed in a future release.
   *
   * @see \Drupal\bootstrap\Plugin\Alter\ThemeSuggestions::getEntityObject
   */
  public function getEntity(Variables $variables, $entity_type = 'entity') {
    Bootstrap::deprecated();
    return $this->getEntityObject($entity_type);
  }

}
