<?php

namespace Drupal\catshop_hotel\Entity;

use Drupal\commerce_store\Entity\EntityStoresInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Defines the interface for hotels.
 */
interface HotelInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface, EntityPublishedInterface, EntityStoresInterface {

  /**
   * Gets the hotel name.
   *
   * @return string
   *   The hotel name
   */
  public function getName();

  /**
   * Sets the hotel name.
   *
   * @param string $name
   *   The hotel name.
   *
   * @return $this
   */
  public function setName($name);

  /**
   * Gets the hotel creation timestamp.
   *
   * @return int
   *   The hotel creation timestamp.
   */
  public function getCreatedTime();

  /**
   * Sets the hotel creation timestamp.
   *
   * @param int $timestamp
   *   The hotel creation timestamp.
   *
   * @return $this
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the room IDs.
   *
   * @return int[]
   *   The room IDs.
   */
  public function getRoomIds();

  /**
   * Gets the rooms.
   *
   * @return \Drupal\catshop_hotel\Entity\RoomInterface[]
   *   The rooms.
   */
  public function getRooms();

  /**
   * Sets the rooms.
   *
   * @param \Drupal\catshop_hotel\Entity\RoomInterface[] $rooms
   *   The rooms.
   *
   * @return $this
   */
  public function setRooms(array $rooms);

  /**
   * Gets whether the hotel has rooms.
   *
   * A hotel must always have at least one room, but a newly initialized
   * (or invalid) hotel entity might not have any.
   *
   * @return bool
   *   TRUE if the hotel has rooms, FALSE otherwise.
   */
  public function hasRooms();

  /**
   * Adds a room.
   *
   * @param \Drupal\catshop_hotel\Entity\RoomInterface $room
   *   The room.
   *
   * @return $this
   */
  public function addRoom(RoomInterface $room);

  /**
   * Removes a room.
   *
   * @param \Drupal\catshop_hotel\Entity\RoomInterface $room
   *   The room.
   *
   * @return $this
   */
  public function removeRoom(RoomInterface $room);

  /**
   * Checks whether the hotel has a given room.
   *
   * @param \Drupal\catshop_hotel\Entity\RoomInterface $room
   *   The room.
   *
   * @return bool
   *   TRUE if the room was found, FALSE otherwise.
   */
  public function hasRoom(RoomInterface $room);

  /**
   * Gets the default room.
   *
   * @return \Drupal\catshop_hotel\Entity\RoomInterface|null
   *   The default room, or NULL if none found.
   */
  public function getDefaultRoom();

}
