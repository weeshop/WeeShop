<?php

namespace Drupal\catshop_hotel\Entity;

use Drupal\commerce\Entity\CommerceContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the hotel room entity class.
 *
 * @ContentEntityType(
 *   id = "catshop_hotel_room",
 *   label = @Translation("Hotel room"),
 *   label_collection = @Translation("Hotel rooms"),
 *   label_singular = @Translation("hotel room"),
 *   label_plural = @Translation("hotel rooms"),
 *   label_count = @PluralTranslation(
 *     singular = "@count hotel room",
 *     plural = "@count hotel rooms",
 *   ),
 *   handlers = {
 *     "event" = "Drupal\catshop_hotel\Event\RoomEvent",
 *     "storage" = "Drupal\commerce\CommerceContentEntityStorage",
 *     "access" = "Drupal\commerce\EmbeddedEntityAccessControlHandler",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\Core\Entity\ContentEntityForm",
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationHandler"
 *   },
 *   admin_permission = "administer catshop_hotel",
 *   fieldable = TRUE,
 *   translatable = TRUE,
 *   content_translation_ui_skip = TRUE,
 *   base_table = "catshop_room",
 *   data_table = "catshop_room_field_data",
 *   entity_keys = {
 *     "id" = "room_id",
 *     "langcode" = "langcode",
 *     "uuid" = "uuid",
 *     "label" = "title",
 *     "status" = "status",
 *   }
 * )
 */
class HotelRoom extends CommerceContentEntityBase implements HotelRoomInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getHotel() {
    return $this->getTranslatedReferencedEntity('hotel_id');
  }

  /**
   * {@inheritdoc}
   */
  public function getHotelId() {
    return $this->get('hotel_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isActive() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setActive($active) {
    $this->set('status', (bool) $active);
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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Author'))
      ->setDescription(t('The hotel room author.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\catshop_hotel\Entity\Room::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayConfigurable('form', TRUE);

    // The product back reference, populated by Hotel::postSave().
    $fields['hotel_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Hotel'))
      ->setDescription(t('The parent hotel.'))
      ->setSetting('target_type', 'catshop_hotel')
      ->setReadOnly(TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The hotel room title.'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Active'))
      ->setDescription(t('Whether the hotel room is active.'))
      ->setDefaultValue(TRUE)
      ->setTranslatable(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 99,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time when the hotel room was created.'))
      ->setTranslatable(TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time when the variation was last edited.'))
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
