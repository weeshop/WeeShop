<?php

namespace Drupal\bootstrap\Plugin\Update;

use Drupal\bootstrap\Theme;

/**
 * Defines the interface for an object oriented preprocess plugin.
 *
 * @ingroup plugins_update
 */
interface UpdateInterface {

  /**
   * Retrieves the update description, if any.
   *
   * @return string
   *   The update description.
   */
  public function getDescription();

  /**
   * Retrieves the human-readable label for the update.
   *
   * @return string
   *   The update label.
   */
  public function getLabel();

  /**
   * Retrieves the provider.
   *
   * @return string
   *   The provider.
   */
  public function getProvider();

  /**
   * Retrieves the update schema.
   *
   * @return int
   *   The update schema.
   */
  public function getSchema();

  /**
   * Retrieves the update severity level.
   *
   * @return string
   *   The update severity level.
   */
  public function getSeverity();

  /**
   * Retrieves the theme that provided the update.
   *
   * Used to determine whether or not the update should apply only to itself
   * (the theme that implemented the plugin) and none of its sub-themes.
   *
   * @return \Drupal\bootstrap\Theme
   *   The theme.
   */
  public function getTheme();

  /**
   * Indicates whether or not the update is private.
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function isPrivate();

  /**
   * The batch process callback for the update.
   *
   * This is the bulk of the update plugin. Be careful to no fill it will a
   * lot of heavily intensive processing. If you need to do a lot of things,
   * split it up into multiple updates so the Batch API can handle it.
   *
   * You can throw an exception from this method in case your processing fails.
   * Its message will be conveyed to the user to indicate what went wrong. If
   * the update has failed, but do not wish to throw an exception, simply
   * return FALSE and a generic "Update failed" message will appear.
   *
   * @param \Drupal\bootstrap\Theme $theme
   *   The theme that the update is being applied to.
   * @param array $context
   *   The Batch API context array, passed by reference. Note: be very careful
   *   to not store any instances created from a theme. The Batch API stores
   *   this in the DB between each "request" and it may not be able to fully
   *   reconstitute the object upon un-serialization. If you need to pass a
   *   theme object between instances, you should instead use an identifier
   *   (string) that can be used to reconstitute the object when needed.
   *
   * @return bool
   *   FALSE if the update failed, otherwise any other return will be
   *   interpreted as TRUE.
   */
  public function process(Theme $theme, array &$context);

}
