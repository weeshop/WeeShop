<?php

namespace Drupal\catshop_hotel;

use Drupal\catshop_hotel\Entity\HotelType;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines the list builder for hotels.
 */
class HotelListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = t('Title');
    $header['type'] = t('Type');
    $header['status'] = t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\catshop_hotel\Entity\HotelInterface $entity */
    $hotel_type = HotelType::load($entity->bundle());

    $row['title']['data'] = [
      '#type' => 'link',
      '#title' => $entity->label(),
    ] + $entity->toUrl()->toRenderArray();
    $row['type'] = $hotel_type->label();
    $row['status'] = $entity->isPublished() ? $this->t('Published') : $this->t('Unpublished');

    return $row + parent::buildRow($entity);
  }

}
