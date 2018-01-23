<?php

namespace Drupal\catshop_hotel\Event;

final class HotelEvents {

  /**
   * Name of the event fired after loading a product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_LOAD = 'catshop_hotel.catshop_hotel.load';

  /**
   * Name of the event fired after creating a new product.
   *
   * Fired before the product is saved.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_CREATE = 'catshop_hotel.catshop_hotel.create';

  /**
   * Name of the event fired before saving a product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_PRESAVE = 'catshop_hotel.catshop_hotel.presave';

  /**
   * Name of the event fired after saving a new product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_INSERT = 'catshop_hotel.catshop_hotel.insert';

  /**
   * Name of the event fired after saving an existing product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_UPDATE = 'catshop_hotel.catshop_hotel.update';

  /**
   * Name of the event fired before deleting a product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_PREDELETE = 'catshop_hotel.catshop_hotel.predelete';

  /**
   * Name of the event fired after deleting a product.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_DELETE = 'catshop_hotel.catshop_hotel.delete';

  /**
   * Name of the event fired after saving a new product translation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_TRANSLATION_INSERT = 'catshop_hotel.catshop_hotel.translation_insert';

  /**
   * Name of the event fired after deleting a product translation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\HotelEvent
   */
  const PRODUCT_TRANSLATION_DELETE = 'catshop_hotel.catshop_hotel.translation_delete';

  /**
   * Name of the event fired after changing the product variation via ajax.
   *
   * Allows modules to add arbitrary ajax commands to the response returned by
   * the add to cart form #ajax callback.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\ProductVariationAjaxChangeEvent
   */
  const PRODUCT_VARIATION_AJAX_CHANGE = 'catshop_hotel.catshop_hotel_variation.ajax_change';

  /**
   * Name of the event fired after loading a product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_LOAD = 'catshop_hotel.catshop_hotel_variation.load';

  /**
   * Name of the event fired after creating a new product variation.
   *
   * Fired before the product variation is saved.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_CREATE = 'catshop_hotel.catshop_hotel_variation.create';

  /**
   * Name of the event fired before saving a product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_PRESAVE = 'catshop_hotel.catshop_hotel_variation.presave';

  /**
   * Name of the event fired after saving a new product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_INSERT = 'catshop_hotel.catshop_hotel_variation.insert';

  /**
   * Name of the event fired after saving an existing product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_UPDATE = 'catshop_hotel.catshop_hotel_variation.update';

  /**
   * Name of the event fired before deleting a product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_PREDELETE = 'catshop_hotel.catshop_hotel_variation.predelete';

  /**
   * Name of the event fired after deleting a product variation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_DELETE = 'catshop_hotel.catshop_hotel_variation.delete';

  /**
   * Name of the event fired after saving a new product variation translation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_TRANSLATION_INSERT = 'catshop_hotel.catshop_hotel_variation.translation_insert';

  /**
   * Name of the event fired after deleting a product variation translation.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\RoomEvent
   */
  const PRODUCT_VARIATION_TRANSLATION_DELETE = 'catshop_hotel.catshop_hotel_variation.translation_delete';

  /**
   * Name of the event fired when filtering variations.
   *
   * @Event
   *
   * @see \Drupal\catshop_hotel\Event\FilterVariationsEvent
   */
  const FILTER_VARIATIONS = "catshop_hotel.filter_variations";

}
