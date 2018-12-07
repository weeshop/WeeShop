<?php

/**
 * @file
 * Fix the class loader to allow cross-request class based theme callbacks.
 */

/**
 * Invokes \Drupal\Core\Extension\ThemeHandler::listInfo.
 *
 * This is in an attempt to ensure theme autoloading works properly.
 *
 * @see \Drupal\bootstrap\Bootstrap::autoloadFixInclude
 */
try {
  \Drupal::service('theme_handler')->listInfo();
}
catch (\Exception $e) {
  // Intentionally left blank.
}
