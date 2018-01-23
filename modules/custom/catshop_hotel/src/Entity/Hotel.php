<?php

namespace Drupal\catshop_hotel\Entity;

use Drupal\commerce\Entity\CommerceContentEntityBase;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the hotel entity class.
 *
 * @ContentEntityType(
 *   id = "catshop_hotel",
 *   label = @Translation("Hotel"),
 *   label_collection = @Translation("Hotels"),
 *   label_singular = @Translation("hotel"),
 *   label_plural = @Translation("hotels"),
 *   label_count = @PluralTranslation(
 *     singular = "@count hotel",
 *     plural = "@count hotels",
 *   ),
 *   bundle_label = @Translation("Hotel type"),
 *   handlers = {
 *     "event" = "Drupal\catshop_hotel\Event\HotelEvent",
 *     "storage" = "Drupal\commerce\CommerceContentEntityStorage",
 *     "access" = "Drupal\commerce\EntityAccessControlHandler",
 *     "permission_provider" = "Drupal\commerce\EntityPermissionProvider",
 *     "view_builder" = "Drupal\catshop_hotel\HotelViewBuilder",
 *     "list_builder" = "Drupal\catshop_hotel\HotelListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\catshop_hotel\Form\HotelForm",
 *       "add" = "Drupal\catshop_hotel\Form\HotelForm",
 *       "edit" = "Drupal\catshop_hotel\Form\HotelForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *       "delete-multiple" = "Drupal\entity\Routing\DeleteMultipleRouteProvider",
 *     },
 *     "translation" = "Drupal\catshop_hotel\HotelTranslationHandler"
 *   },
 *   admin_permission = "administer catshop_hotel",
 *   permission_granularity = "bundle",
 *   fieldable = TRUE,
 *   translatable = TRUE,
 *   base_table = "catshop_hotel",
 *   data_table = "catshop_hotel_field_data",
 *   entity_keys = {
 *     "id" = "hotel_id",
 *     "bundle" = "type",
 *     "label" = "name",
 *     "langcode" = "langcode",
 *     "uuid" = "uuid",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/hotel/{catshop_hotel}",
 *     "add-page" = "/hotel/add",
 *     "add-form" = "/hotel/add/{catshop_hotel_type}",
 *     "edit-form" = "/hotel/{catshop_hotel}/edit",
 *     "delete-form" = "/hotel/{catshop_hotel}/delete",
 *     "delete-multiple-form" = "/admin/commerce/hotels/delete",
 *     "collection" = "/admin/commerce/hotels"
 *   },
 *   bundle_entity_type = "catshop_hotel_type",
 *   field_ui_base_route = "entity.catshop_hotel_type.edit_form",
 * )
 */
class Hotel extends CommerceContentEntityBase implements HotelInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getStores() {
    return $this->getTranslatedReferencedEntities('stores');
  }

  /**
   * {@inheritdoc}
   */
  public function setStores(array $stores) {
    $this->set('stores', $stores);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getStoreIds() {
    $store_ids = [];
    foreach ($this->get('stores') as $store_item) {
      $store_ids[] = $store_item->target_id;
    }
    return $store_ids;
  }

  /**
   * {@inheritdoc}
   */
  public function setStoreIds(array $store_ids) {
    $this->set('stores', $store_ids);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHotelRoomIds() {
    $hotel_room_ids = [];
    foreach ($this->get('hotel_rooms') as $field_item) {
      $hotel_room_ids[] = $field_item->target_id;
    }
    return $hotel_room_ids;
  }

  /**
   * {@inheritdoc}
   */
  public function getHotelRooms() {
    return $this->getTranslatedReferencedEntities('hotel_rooms');
  }

  /**
   * {@inheritdoc}
   */
  public function setHotelRooms(array $hotel_rooms) {
    $this->set('hotel_rooms', $hotel_rooms);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hasHotelRooms() {
    return !$this->get('hotel_rooms')->isEmpty();
  }

  /**
   * {@inheritdoc}
   */
  public function addHotelRoom(HotelRoomInterface $hotel_room) {
    if (!$this->hasHotelRoom($hotel_room)) {
      $this->get('hotel_rooms')->appendItem($hotel_room);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function removeHotelRoom(HotelRoomInterface $hotel_room) {
    $index = $this->getVariationIndex($hotel_room);
    if ($index !== FALSE) {
      $this->get('hotel_rooms')->offsetUnset($index);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hasHotelRoom(HotelRoomInterface $hotel_room) {
    return in_array($hotel_room->id(), $this->getHotelRoomIds());
  }

  /**
   * Gets the index of the given hotel_room.
   *
   * @param \Drupal\catshop_hotel\Entity\HotelRoomInterface $hotel_room
   *   The hotel_room.
   *
   * @return int|bool
   *   The index of the given hotel_room, or FALSE if not found.
   */
  protected function getHotelRoomIndex(HotelRoomInterface $hotel_room) {
    return array_search($hotel_room->id(), $this->getHotelRoomIds());
  }

  /**
   * {@inheritdoc}
   */
  public function getDefaultHotelRoom() {
    foreach ($this->getHotelRooms() as $hotel_room) {
      // Return the first active hotel_room.
      if ($hotel_room->isActive() && $hotel_room->access('view')) {
        return $hotel_room;
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function postSave(EntityStorageInterface $storage, $update = TRUE) {
    parent::postSave($storage, $update);

    // Ensure there's a back-reference on each hotel hotel_room.
    foreach ($this->hotel_rooms as $item) {
      $hotel_room = $item->entity;
      if ($hotel_room->hotel_id->isEmpty()) {
        $hotel_room->hotel_id = $this->id();
        $hotel_room->save();
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function postDelete(EntityStorageInterface $storage, array $entities) {
    // Delete the hotel hotel_rooms of a deleted hotel.
    $hotel_rooms = [];
    foreach ($entities as $entity) {
      if (empty($entity->hotel_rooms)) {
        continue;
      }
      foreach ($entity->hotel_rooms as $item) {
        $hotel_rooms[$item->target_id] = $item->entity;
      }
    }
    $hotel_room_storage = \Drupal::service('entity_type.manager')->getStorage('catshop_hotel_room');
    $hotel_room_storage->delete($hotel_rooms);
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Author'))
      ->setDescription(t('The hotel author.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\catshop_hotel\Entity\Hotel::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The hotel name.'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['path'] = BaseFieldDefinition::create('path')
      ->setLabel(t('URL alias'))
      ->setDescription(t('The hotel URL alias.'))
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'path',
        'weight' => 30,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setComputed(TRUE);

    $fields['status']
      ->setLabel(t('Published'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => 90,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time when the hotel was created.'))
      ->setTranslatable(TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time when the hotel was last edited.'))
      ->setTranslatable(TRUE);

    return $fields;
  }

  /**
   * Default value callback for 'uid' base field definition.
   *
   * @see ::baseFieldDefinitions()
   *
   * @return array
   *   An array of default values.
   */
  public static function getCurrentUserId() {
    return [\Drupal::currentUser()->id()];
  }

}
