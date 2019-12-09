<?php

namespace Drupal\weeshop_service\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\file\Entity\File;
use Drupal\node\NodeStorageInterface;

/**
 * Provides a 'ServiceBannerBlock' block.
 *
 * @Block(
 *  id = "weeshop_service_banner_block",
 *  admin_label = @Translation("Service banner block"),
 * )
 */
class ServiceBannerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $services = [];

    /** @var NodeStorageInterface $nodeStorage */
    $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
    $nodes = $nodeStorage->loadByProperties([
      'type' => 'service'
    ]);

    foreach ($nodes as $node) {
      /** @var File $image_file */
      $image_file = $node->get('field_image')->entity;
      $services[] = [
        'title' => $node->label(),
        'image' => $image_file->url(),
        'node' => $node
      ];
    }

    $build = [];
    $build['#theme'] = 'weeshop_service_banner_block';
    $build['#services'] = $services;

    return $build;
  }

}
