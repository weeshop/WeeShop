<?php

namespace Drupal\bootstrap\Utility;

use Drupal\Core\Template\Attribute;

/**
 * Class for managing multiple types of attributes commonly found in Drupal.
 *
 * @ingroup utility
 *
 * @see \Drupal\bootstrap\Utility\Attributes
 * @see \Drupal\bootstrap\Utility\Element
 * @see \Drupal\bootstrap\Utility\Variables
 */
class DrupalAttributes extends ArrayObject {

  /**
   * Defines the "attributes" storage type constant.
   *
   * @var string
   */
  const ATTRIBUTES = 'attributes';

  /**
   * Defines the "body_attributes" storage type constant.
   *
   * @var string
   */
  const BODY = 'body_attributes';

  /**
   * Defines the "content_attributes" storage type constant.
   *
   * @var string
   */
  const CONTENT = 'content_attributes';

  /**
   * Defines the "description_attributes" storage type constant.
   *
   * @var string
   */
  const DESCRIPTION = 'description_attributes';

  /**
   * Defines the "footer_attributes" storage type constant.
   *
   * @var string
   */
  const FOOTER = 'footer_attributes';

  /**
   * Defines the "header_attributes" storage type constant.
   *
   * @var string
   */
  const HEADER = 'header_attributes';

  /**
   * Defines the "heading_attributes" storage type constant.
   *
   * @var string
   */
  const HEADING = 'heading_attributes';

  /**
   * Defines the "input_group_attributes" storage type constant.
   *
   * @var string
   */
  const INPUT_GROUP = 'input_group_attributes';

  /**
   * Defines the "label_attributes" storage type constant.
   *
   * @var string
   */
  const LABEL = 'label_attributes';

  /**
   * Defines the "navbar_attributes" storage type constant.
   *
   * @var string
   */
  const NAVBAR = 'navbar_attributes';

  /**
   * Defines the "split_button_attributes" storage type constant.
   *
   * @var string
   */
  const SPLIT_BUTTON = 'split_button_attributes';

  /**
   * Defines the "title_attributes" storage type constant.
   *
   * @var string
   */
  const TITLE = 'title_attributes';

  /**
   * Defines the "wrapper_attributes" storage type constant.
   *
   * @var string
   */
  const WRAPPER = 'wrapper_attributes';

  /**
   * Stored attribute instances.
   *
   * @var \Drupal\bootstrap\Utility\Attributes[]
   */
  protected $attributes = [];

  /**
   * A prefix to use for retrieving attribute keys from the array.
   *
   * @var string
   */
  protected $attributePrefix = '';

  /**
   * Add class(es) to an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then add the class(es) to it.
   *
   * @param string|array $class
   *   An individual class or an array of classes to add.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::addClass()
   */
  public function addClass($class, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->addClass($class);
    return $this;
  }

  /**
   * Retrieve a specific attribute from an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then retrieve the attribute from it.
   *
   * @param string $name
   *   The specific attribute to retrieve.
   * @param mixed $default
   *   (optional) The default value to set if the attribute does not exist.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return mixed
   *   A specific attribute value, passed by reference.
   *
   * @see \Drupal\bootstrap\Utility\Attributes::getAttribute()
   */
  public function &getAttribute($name, $default = NULL, $type = DrupalAttributes::ATTRIBUTES) {
    return $this->getAttributes($type)->getAttribute($name, $default);
  }

  /**
   * Retrieves a specific attributes object.
   *
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return \Drupal\bootstrap\Utility\Attributes
   *   An attributes object for $type.
   */
  public function getAttributes($type = DrupalAttributes::ATTRIBUTES) {
    if (!isset($this->attributes[$type])) {
      $attributes = &$this->offsetGet($this->attributePrefix . $type, []);
      if ($attributes instanceof Attribute) {
        $attributes = $attributes->toArray();
      }
      $this->attributes[$type] = new Attributes($attributes);
    }
    return $this->attributes[$type];
  }

  /**
   * Retrieves classes from an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then retrieve the set classes from it.
   *
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return array
   *   The classes array, passed by reference.
   *
   * @see \Drupal\bootstrap\Utility\Attributes::getClasses()
   */
  public function &getClasses($type = DrupalAttributes::ATTRIBUTES) {
    return $this->getAttributes($type)->getClasses();
  }

  /**
   * Indicates whether an attributes object has a specific attribute set.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then check there if the attribute exists.
   *
   * @param string $name
   *   The attribute to search for.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return bool
   *   TRUE or FALSE
   *
   * @see \Drupal\bootstrap\Utility\Attributes::hasAttribute()
   */
  public function hasAttribute($name, $type = DrupalAttributes::ATTRIBUTES) {
    return $this->getAttributes($type)->hasAttribute($name);
  }

  /**
   * Indicates whether an attributes object has a specific class.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then check there if a class exists in the attributes object.
   *
   * @param string $class
   *   The class to search for.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return bool
   *   TRUE or FALSE
   *
   * @see \Drupal\bootstrap\Utility\Attributes::hasClass()
   */
  public function hasClass($class, $type = DrupalAttributes::ATTRIBUTES) {
    return $this->getAttributes($type)->hasClass($class);
  }

  /**
   * Removes an attribute from an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then remove an attribute from it.
   *
   * @param string|array $name
   *   The name of the attribute to remove.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::removeAttribute()
   */
  public function removeAttribute($name, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->removeAttribute($name);
    return $this;
  }

  /**
   * Removes a class from an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then remove the class(es) from it.
   *
   * @param string|array $class
   *   An individual class or an array of classes to remove.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::removeClass()
   */
  public function removeClass($class, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->removeClass($class);
    return $this;
  }

  /**
   * Replaces a class in an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then replace the class(es) in it.
   *
   * @param string $old
   *   The old class to remove.
   * @param string $new
   *   The new class. It will not be added if the $old class does not exist.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::replaceClass()
   */
  public function replaceClass($old, $new, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->replaceClass($old, $new);
    return $this;
  }

  /**
   * Sets an attribute on an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then set an attribute on it.
   *
   * @param string $name
   *   The name of the attribute to set.
   * @param mixed $value
   *   The value of the attribute to set.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::setAttribute()
   */
  public function setAttribute($name, $value, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->setAttribute($name, $value);
    return $this;
  }

  /**
   * Sets multiple attributes on an attributes object.
   *
   * This is a wrapper method to retrieve the correct attributes storage object
   * and then merge multiple attributes into it.
   *
   * @param array $values
   *   An associative key/value array of attributes to set.
   * @param string $type
   *   (optional) The type of attributes to use for this method.
   *
   * @return $this
   *
   * @see \Drupal\bootstrap\Utility\Attributes::setAttributes()
   */
  public function setAttributes(array $values, $type = DrupalAttributes::ATTRIBUTES) {
    $this->getAttributes($type)->setAttributes($values);
    return $this;
  }

}
