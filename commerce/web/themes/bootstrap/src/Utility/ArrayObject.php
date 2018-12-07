<?php

namespace Drupal\bootstrap\Utility;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Cache\RefinableCacheableDependencyInterface;
use Drupal\Core\Render\AttachmentsInterface;
use Drupal\Core\Render\BubbleableMetadata;

/**
 * Custom ArrayObject implementation.
 *
 * The native ArrayObject is unnecessarily complicated.
 *
 * @ingroup utility
 */
class ArrayObject implements \IteratorAggregate, \ArrayAccess, \Serializable, \Countable, AttachmentsInterface, RefinableCacheableDependencyInterface {

  /**
   * The array.
   *
   * @var array
   */
  protected $array;

  /**
   * Array object constructor.
   *
   * @param array $array
   *   An array.
   */
  public function __construct(array $array = []) {
    $this->array = $array;
  }

  /**
   * Returns whether the requested key exists.
   *
   * @param mixed $key
   *   A key.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function __isset($key) {
    return $this->offsetExists($key);
  }

  /**
   * Sets the value at the specified key to value.
   *
   * @param mixed $key
   *   A key.
   * @param mixed $value
   *   A value.
   */
  public function __set($key, $value) {
    $this->offsetSet($key, $value);
  }

  /**
   * Unsets the value at the specified key.
   *
   * @param mixed $key
   *   A key.
   */
  public function __unset($key) {
    $this->offsetUnset($key);
  }

  /**
   * Returns the value at the specified key by reference.
   *
   * @param mixed $key
   *   A key.
   *
   * @return mixed
   *   The stored value.
   */
  public function &__get($key) {
    $ret =& $this->offsetGet($key);
    return $ret;
  }

  /**
   * {@inheritdoc}
   */
  public function addAttachments(array $attachments) {
    BubbleableMetadata::createFromRenderArray($this->array)->addAttachments($attachments)->applyTo($this->array);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function addCacheContexts(array $cache_contexts) {
    BubbleableMetadata::createFromRenderArray($this->array)->addCacheContexts($cache_contexts)->applyTo($this->array);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function addCacheTags(array $cache_tags) {
    BubbleableMetadata::createFromRenderArray($this->array)->addCacheTags($cache_tags)->applyTo($this->array);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function addCacheableDependency($other_object) {
    BubbleableMetadata::createFromRenderArray($this->array)->addCacheableDependency($other_object)->applyTo($this->array);
    return $this;
  }

  /**
   * Appends the value.
   *
   * @param mixed $value
   *   A value.
   */
  public function append($value) {
    $this->array[] = $value;
  }

  /**
   * Sort the entries by value.
   */
  public function asort() {
    asort($this->array);
  }

  /**
   * Merges an object's cacheable metadata into the variables array.
   *
   * @param \Drupal\Core\Cache\CacheableDependencyInterface|mixed $object
   *   The object whose cacheability metadata to retrieve. If it implements
   *   CacheableDependencyInterface, its cacheability metadata will be used,
   *   otherwise, the passed in object must be assumed to be uncacheable, so
   *   max-age 0 is set.
   *
   * @return $this
   */
  public function bubbleObject($object) {
    BubbleableMetadata::createFromRenderArray($this->array)->merge(BubbleableMetadata::createFromObject($object))->applyTo($this->array);
    return $this;
  }

  /**
   * Merges a render array's cacheable metadata into the variables array.
   *
   * @param array $build
   *   A render array.
   *
   * @return $this
   */
  public function bubbleRenderArray(array $build) {
    BubbleableMetadata::createFromRenderArray($this->array)->merge(BubbleableMetadata::createFromRenderArray($build))->applyTo($this->array);
    return $this;
  }

  /**
   * Get the number of public properties in the ArrayObject.
   *
   * @return int
   *   The count.
   */
  public function count() {
    return count($this->array);
  }

  /**
   * Exchange the array for another one.
   *
   * @param array|ArrayObject $data
   *   New data.
   *
   * @return array
   *   The old array.
   *
   * @throws \InvalidArgumentException
   *   When the passed data is not an array or an instance of ArrayObject.
   */
  public function exchangeArray($data) {
    if (!is_array($data) && is_object($data) && !($data instanceof ArrayObject)) {
      throw new \InvalidArgumentException('Passed variable is not an array or an instance of \Drupal\bootstrap\Utility\ArrayObject.');
    }
    if (is_object($data) && $data instanceof ArrayObject) {
      $data = $data->getArrayCopy();
    }
    $old = $this->array;
    $this->array = $data;
    return $old;
  }

  /**
   * Creates a copy of the ArrayObject.
   *
   * @return array
   *   A copy of the array.
   */
  public function getArrayCopy() {
    return $this->array;
  }

  /**
   * {@inheritdoc}
   */
  public function getAttachments() {
    return BubbleableMetadata::createFromRenderArray($this->array)->getAttachments();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return BubbleableMetadata::createFromRenderArray($this->array)->getCacheContexts();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return BubbleableMetadata::createFromRenderArray($this->array)->getCacheTags();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return BubbleableMetadata::createFromRenderArray($this->array)->getCacheMaxAge();
  }

  /**
   * Creates a new iterator from an ArrayObject instance.
   *
   * @return \ArrayIterator
   *   An array iterator.
   */
  public function getIterator() {
    return new \ArrayIterator($this->array);
  }

  /**
   * Sort the entries by key.
   */
  public function ksort() {
    ksort($this->array);
  }

  /**
   * Merges multiple values into the array.
   *
   * @param array $values
   *   An associative key/value array.
   * @param bool $recursive
   *   Flag determining whether or not to recursively merge key/value pairs.
   */
  public function merge(array $values, $recursive = TRUE) {
    if ($recursive) {
      $this->array = NestedArray::mergeDeepArray([$this->array, $values], TRUE);
    }
    else {
      $this->array += $values;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function mergeCacheMaxAge($max_age) {
    BubbleableMetadata::createFromRenderArray($this->array)->mergeCacheMaxAge($max_age)->applyTo($this->array);
    return $this;
  }

  /**
   * Sort an array using a case insensitive "natural order" algorithm.
   */
  public function natcasesort() {
    natcasesort($this->array);
  }

  /**
   * Sort entries using a "natural order" algorithm.
   */
  public function natsort() {
    natsort($this->array);
  }

  /**
   * Returns whether the requested key exists.
   *
   * @param mixed $key
   *   A key.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function offsetExists($key) {
    return isset($this->array[$key]);
  }

  /**
   * Returns the value at the specified key.
   *
   * @param mixed $key
   *   A key.
   * @param mixed $default
   *   The default value to set if $key does not exist.
   *
   * @return mixed
   *   The value.
   */
  public function &offsetGet($key, $default = NULL) {
    if (!$this->offsetExists($key)) {
      $this->array[$key] = $default;
    }
    $ret = &$this->array[$key];
    return $ret;
  }

  /**
   * Sets the value at the specified key to value.
   *
   * @param mixed $key
   *   A key.
   * @param mixed $value
   *   A value.
   */
  public function offsetSet($key, $value) {
    $this->array[$key] = $value;
  }

  /**
   * Unsets the value at the specified key.
   *
   * @param mixed $key
   *   A key.
   */
  public function offsetUnset($key) {
    if ($this->offsetExists($key)) {
      unset($this->array[$key]);
    }
  }

  /**
   * Serialize an ArrayObject.
   *
   * @return string
   *   The serialized value.
   */
  public function serialize() {
    return serialize(get_object_vars($this));
  }

  /**
   * {@inheritdoc}
   */
  public function setAttachments(array $attachments) {
    BubbleableMetadata::createFromRenderArray($this->array)->setAttachments($attachments)->applyTo($this->array);
    return $this;
  }

  /**
   * Sort entries with a user-defined function and maintain key association.
   *
   * @param mixed $function
   *   A callable function.
   */
  public function uasort($function) {
    if (is_callable($function)) {
      uasort($this->array, $function);
    }
  }

  /**
   * Sort the entries by keys using a user-defined comparison function.
   *
   * @param mixed $function
   *   A callable function.
   */
  public function uksort($function) {
    if (is_callable($function)) {
      uksort($this->array, $function);
    }
  }

  /**
   * Unserialize an ArrayObject.
   *
   * @param string $data
   *   The serialized data.
   */
  public function unserialize($data) {
    $data = unserialize($data);
    $this->exchangeArray($data['array']);
  }

}
