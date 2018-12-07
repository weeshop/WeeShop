<?php

namespace Drupal\bootstrap\Utility;

use Drupal\Core\KeyValueStore\MemoryStorage;

/**
 * Theme Storage Item.
 *
 * This is essentially the same object as Storage. The only exception is
 * delegating any data changes to the primary Storage object this
 * StorageItem object lives in.
 *
 * This storage object can be used in `foreach` loops.
 *
 * @ingroup utility
 *
 * @see \Drupal\bootstrap\Utility\Storage
 */
class StorageItem extends MemoryStorage implements \Iterator {

  /**
   * Flag determining whether or not object has been initialized yet.
   *
   * @var bool
   */
  protected $initialized = FALSE;

  /**
   * The \Drupal\bootstrap\Storage instance this item belongs to.
   *
   * @var \Drupal\bootstrap\Utility\Storage
   */
  protected $storage;

  /**
   * {@inheritdoc}
   */
  public function __construct($data, Storage $storage) {
    $this->storage = $storage;
    $this->setMultiple($data);
    $this->initialized = TRUE;
  }

  /**
   * Notifies the main Storage object that data has changed.
   */
  public function changed() {
    if ($this->initialized) {
      $this->storage->changed();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function current() {
    return current($this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function delete($key) {
    parent::delete($key);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function deleteMultiple(array $keys) {
    parent::deleteMultiple($keys);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function deleteAll() {
    parent::deleteAll();
    $this->changed();
  }

  /**
   * Determines if the cache is empty.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function isEmpty() {
    return empty($this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function key() {
    return key($this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function next() {
    return next($this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function rename($key, $new_key) {
    parent::rename($key, $new_key);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function rewind() {
    return reset($this->data);
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, $value) {
    parent::set($key, $value);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function setIfNotExists($key, $value) {
    if (!isset($this->data[$key])) {
      $this->data[$key] = $value;
      $this->changed();
      return TRUE;
    }
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function setMultiple(array $data) {
    parent::setMultiple($data);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function valid() {
    return key($this->data) !== NULL;
  }

}
