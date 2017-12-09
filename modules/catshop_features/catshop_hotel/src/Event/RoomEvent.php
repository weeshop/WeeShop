<?php

namespace Drupal\catshop_hotel\Event;

use Drupal\catshop_hotel\Entity\RoomInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Defines the hotel room event.
 *
 * @see \Drupal\catshop_hotel\Event\ProductEvents
 */
class RoomEvent extends Event {

  /**
   * The hotel room.
   *
   * @var \Drupal\catshop_hotel\Entity\RoomInterface
   */
  protected $room;

  /**
   * Constructs a new RoomEvent.
   *
   * @param \Drupal\catshop_hotel\Entity\RoomInterface $room
   *   The hotel room.
   */
  public function __construct(RoomInterface $room) {
    $this->room = $room;
  }

  /**
   * Gets the hotel room.
   *
   * @return \Drupal\catshop_hotel\Entity\RoomInterface
   *   The hotel room.
   */
  public function getRoom() {
    return $this->room;
  }

}
