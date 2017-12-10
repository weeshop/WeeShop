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
   * Gets the hotel room IDs.
   *
   * @return int[]
   *   The hotel room IDs.
   */
  public function getHotelRoomIds();

  /**
   * Gets the hotel rooms.
   *
   * @return \Drupal\catshop_hotel\Entity\HotelRoomInterface[]
   *   The hotel rooms.
   */
  public function getHotelRooms();

  /**
   * Sets the hotel rooms.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelRoomInterface[] $hotel_rooms
   *   The hotel rooms.
   *
   * @return $this
   */
  public function setHotelRooms(array $hotel_rooms);

  /**
   * Gets whether the hotel has hotel rooms.
   *
   * A hotel must always have at least one hotel room, but a newly initialized
   * (or invalid) hotel entity might not have any.
   *
   * @return bool
   *   TRUE if the hotel has hotel rooms, FALSE otherwise.
   */
  public function hasHotelRooms();

  /**
   * Adds a hotel room.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelRoomInterface $hotel_room
   *   The hotel room.
   *
   * @return $this
   */
  public function addHotelRoom(HotelRoomInterface $hotel_room);

  /**
   * Removes a hotel room.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelRoomInterface $hotel_room
   *   The hotel room.
   *
   * @return $this
   */
  public function removeHotelRoom(HotelRoomInterface $hotel_room);

  /**
   * Checks whether the hotel has a given hotel room.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelRoomInterface $hotel_room
   *   The hotel room.
   *
   * @return bool
   *   TRUE if the hotel room was found, FALSE otherwise.
   */
  public function hasHotelRoom(HotelRoomInterface $hotel_room);

  /**
   * Gets the default hotel room.
   *
   * @return \Drupal\catshop_hotel\Entity\HotelRoomInterface|null
   *   The default hotel room, or NULL if none found.
   */
  public function getDefaultHotelRoom();

}
