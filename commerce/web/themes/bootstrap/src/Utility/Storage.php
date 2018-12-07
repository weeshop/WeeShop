<?php

namespace Drupal\bootstrap\Utility;

use Drupal\bootstrap\Bootstrap;
use Drupal\Core\Cache\Cache;
use Drupal\Core\KeyValueStore\MemoryStorage;

/**
 * Theme Storage.
 *
 * A hybrid storage solution that utilizes the cache system for complex and
 * expensive operations performed by a [base] theme.
 *
 * Instead of using multiple cache identifiers, which increases the number of
 * database calls, this storage only executes a single cache call and stores
 * individual entries in memory as an associative array.
 *
 * It also tracks when the data has been modified so it can be saved back to
 * cache before the system fully shuts down.
 *
 * This storage object can be used in `foreach` loops.
 *
 * @ingroup utility
 *
 * @see \Drupal\bootstrap\Utility\StorageItem
 */
class Storage extends MemoryStorage implements \Iterator {

  /**
   * The bin (table) data should be stored in (not prefixed with "cache_").
   *
   * @var string
   */
  protected $bin;

  /**
   * Flag determining whether or not the cache should be saved to the database.
   *
   * @var bool
   */
  protected $changed;

  /**
   * The cache identifier.
   *
   * @var string
   */
  protected $cid;

  /**
   * Indicates when the cache should expire.
   *
   * @var string
   */
  protected $expire;

  /**
   * Flag determining whether or not object has been initialized yet.
   *
   * @var bool
   */
  protected $initialized = FALSE;

  /**
   * Tags to associate with the cached data so it can be properly invalidated.
   *
   * @var string
   */
  protected $tags;

  /**
   * {@inheritdoc}
   */
  public function __construct($cid, $bin = 'default', $expire = Cache::PERMANENT, $tags = [Bootstrap::CACHE_TAG]) {
    $this->cid = "theme_registry:storage:$cid";
    $this->bin = $bin;
    $this->changed = FALSE;
    $this->expire = $expire;
    $this->tags = $tags;

    // Register the cache object to save, if it's needed, on shutdown.
    drupal_register_shutdown_function([$this, 'save']);

    // Retrieve the cached data.
    $data = ($cached = \Drupal::cache($bin)->get($this->cid)) && !empty($cached->data) ? $cached->data : [];

    // Set the data.
    $this->setMultiple($data);

    // Cache has been initialized.
    $this->initialized = TRUE;
  }

  /**
   * Notifies the object that data has changed.
   */
  public function changed() {
    if ($this->initialized) {
      $this->changed = TRUE;
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
  public function deleteAll() {
    parent::deleteAll();
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
  public function getAll($arrays = TRUE) {
    $data = $this->data;
    if ($arrays) {
      foreach ($data as $key => $value) {
        if ($value instanceof StorageItem) {
          $data[$key] = $value->getAll();
        }
      }
    }
    return $data;
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
   * Saves the data back to the database, if necessary, on shutdown.
   *
   * This method is automatically invoked during PHP shutdown.
   *
   * @internal
   *
   * @see \Drupal\bootstrap\Utility\Storage::__construct
   */
  public function save() {
    if ($this->changed) {
      \Drupal::cache($this->bin)->set($this->cid, $this->getAll(), $this->expire, $this->tags);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, $value) {
    if (is_array($value)) {
      $value = new StorageItem($value, $this);
    }
    parent::set($key, $value);
    $this->changed();
  }

  /**
   * {@inheritdoc}
   */
  public function setIfNotExists($key, $value) {
    if (!isset($this->data[$key])) {
      if (is_array($value)) {
        $value = new StorageItem($value, $this);
      }
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
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $data[$key] = new StorageItem($value, $this);
      }
    }
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
