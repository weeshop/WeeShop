<?php

namespace Drupal\catshop_hotel\Event;

use Drupal\catshop_hotel\Entity\HotelInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Defines the hotel event.
 *
 * @see \Drupal\catshop_hotel\Event\HotelEvents
 */
class HotelEvent extends Event {

  /**
   * The hotel.
   *
   * @var \Drupal\catshop_hotel\Entity\HotelInterface
   */
  protected $hotel;

  /**
   * Constructs a new HotelEvent.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelInterface $hotel
   *   The hotel.
   */
  public function __construct(HotelInterface $hotel) {
    $this->hotel = $hotel;
  }

  /**
   * Gets the hotel.
   *
   * @return \Drupal\catshop_hotel\Entity\HotelInterface
   *   The hotel.
   */
  public function getHotel() {
    return $this->hotel;
  }

}
