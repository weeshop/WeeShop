<?php

/**
 * @file
 * Icon API support to provide Bootstrap Framework glyphicons.
 */

use Drupal\bootstrap\Bootstrap;

/**
 * Implements hook_icon_providers().
 */
function bootstrap_icon_providers() {
  $providers['bootstrap'] = [
    'title' => t('Bootstrap'),
    'url' => 'https://getbootstrap.com/docs/3.3/components/#glyphicons',
  ];
  return $providers;
}

/**
 * Implements hook_icon_bundles().
 */
function bootstrap_icon_bundles() {
  $bundles = [];
  if (Bootstrap::getTheme()->hasGlyphicons()) {
    $bundles['bootstrap'] = [
      'render' => 'sprite',
      'provider' => 'bootstrap',
      'title' => t('Bootstrap'),
      'version' => t('Icons by Glyphicons'),
      'variations' => [
        'icon-white' => t('White'),
      ],
      'settings' => [
        'tag' => 'span',
      ],
      'icons' => Bootstrap::glyphicons(),
    ];
  }
  return $bundles;
}
