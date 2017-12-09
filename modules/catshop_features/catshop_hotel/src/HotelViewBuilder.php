<?php

namespace Drupal\catshop_hotel;

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\EntityRepository;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityViewBuilder;
use Drupal\Core\Language\LanguageManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the entity view builder for products.
 */
class HotelViewBuilder extends EntityViewBuilder {

  /**
   * The product field variation renderer.
   *
   * @var \Drupal\commerce_product\ProductVariationFieldRenderer
   */
  protected $variationFieldRenderer;

  /**
   * The entity repository.
   *
   * @var \Drupal\Core\Entity\EntityRepository
   */
  protected $entityRepository;

  /**
   * Constructs a new ProductViewBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager service.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\commerce_product\ProductVariationFieldRenderer $variation_field_renderer
   *   The product variation field renderer.
   * @param \Drupal\Core\Entity\EntityRepository $entity_repository
   *   The entity repository.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityManagerInterface $entity_manager, LanguageManagerInterface $language_manager, ProductVariationFieldRenderer $variation_field_renderer, EntityRepository $entity_repository) {
    parent::__construct($entity_type, $entity_manager, $language_manager);
    $this->variationFieldRenderer = $variation_field_renderer;
    $this->entityRepository = $entity_repository;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity.manager'),
      $container->get('language_manager'),
      $container->get('commerce_product.variation_field_renderer'),
      $container->get('entity.repository')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function alterBuild(array &$build, EntityInterface $entity, EntityViewDisplayInterface $display, $view_mode) {
    $product_type_storage = $this->entityManager->getStorage('commerce_product_type');
    /** @var \Drupal\commerce_product\ProductVariationStorageInterface $variation_storage */
    $variation_storage = $this->entityManager->getStorage('commerce_product_variation');
    /** @var \Drupal\commerce_product\Entity\ProductTypeInterface $product_type */
    $product_type = $product_type_storage->load($entity->bundle());
    if ($product_type->shouldInjectVariationFields() && $entity->getDefaultVariation()) {
      $variation = $variation_storage->loadFromContext($entity);
      $variation = $this->entityRepository->getTranslationFromContext($variation, $entity->language()->getId());
      $attribute_field_names = $variation->getAttributeFieldNames();
      $rendered_fields = $this->variationFieldRenderer->renderFields($variation, $view_mode);
      foreach ($rendered_fields as $field_name => $rendered_field) {
        // Group attribute fields to allow them to be excluded together.
        if (in_array($field_name, $attribute_field_names)) {
          $build['variation_attributes']['variation_' . $field_name] = $rendered_field;
        }
        else {
          $build['variation_' . $field_name] = $rendered_field;
        }
      }
    }
  }

}
