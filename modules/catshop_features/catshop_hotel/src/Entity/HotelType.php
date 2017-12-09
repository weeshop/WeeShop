<?php

namespace Drupal\catshop_hotel\Entity;

use Drupal\commerce\Entity\CommerceBundleEntityBase;

/**
 * Defines the hotel type entity class.
 *
 * @ConfigEntityType(
 *   id = "catshop_hotel_type",
 *   label = @Translation("Hotel type"),
 *   label_collection = @Translation("Hotel types"),
 *   label_singular = @Translation("hotel type"),
 *   label_plural = @Translation("hotel types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count hotel type",
 *     plural = "@count hotel types",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\catshop_hotel\HotelTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\catshop_hotel\Form\HotelTypeForm",
 *       "edit" = "Drupal\catshop_hotel\Form\HotelTypeForm",
 *       "delete" = "Drupal\commerce\Form\CommerceBundleEntityDeleteFormBase"
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "catshop_hotel_type",
 *   admin_permission = "administer catshop_hotel_type",
 *   bundle_of = "catshop_hotel",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "traits",
 *   },
 *   links = {
 *     "add-form" = "/admin/commerce/config/hotel-types/add",
 *     "edit-form" = "/admin/commerce/config/hotel-types/{catshop_hotel_type}/edit",
 *     "delete-form" = "/admin/commerce/config/hotel-types/{catshop_hotel_type}/delete",
 *     "collection" = "/admin/commerce/config/hotel-types"
 *   }
 * )
 */
class HotelType extends CommerceBundleEntityBase {

  /**
   * The hotel type description.
   *
   * @var string
   */
  protected $description;

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

}
