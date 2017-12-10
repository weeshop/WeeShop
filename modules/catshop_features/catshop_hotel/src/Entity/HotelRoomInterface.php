<?php

namespace Drupal\catshop_hotel\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Defines the interface for rooms.
 */
interface HotelRoomInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the parent hotel.
   *
   * @return HotelInterface|null
   *   The hotel entity, or null.
   */
  public function getHotel();

  /**
   * Gets the parent hotel ID.
   *
   * @return int|null
   *   The hotel ID, or null.
   */
  public function getHotelId();

  /**
   * Gets the room title.
   *
   * @return string
   *   The room title
   */
  public function getTitle();

  /**
   * Sets the room title.
   *
   * @param string $title
   *   The room title.
   *
   * @return $this
   */
  public function setTitle($title);

  /**
   * Gets whether the room is active.
   *
   * Inactive rooms are not visible on add to cart forms.
   *
   * @return bool
   *   TRUE if the room is active, FALSE otherwise.
   */
  public function isActive();

  /**
   * Sets whether the room is active.
   *
   * @param bool $active
   *   Whether the room is active.
   *
   * @return $this
   */
  public function setActive($active);

  /**
   * Gets the room creation timestamp.
   *
   * @return int
   *   The room creation timestamp.
   */
  public function getCreatedTime();

  /**
   * Sets the room creation timestamp.
   *
   * @param int $timestamp
   *   The room creation timestamp.
   *
   * @return $this
   */
  public function setCreatedTime($timestamp);

}
