<?php

/**
 * @file
 * Enables modules and site configuration for a commerce_base site installation.
 */

use Drupal\contact\Entity\ContactForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function weeshop_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  // Add a placeholder as example that one can choose an arbitrary site name.
  $form['site_information']['site_name']['#attributes']['placeholder'] = t('My store');
  $form['#submit'][] = 'commerce_base_form_install_configure_submit';
}

/**
 * Submission handler to sync the contact.form.feedback recipient.
 */
function weeshop_form_install_configure_submit($form, FormStateInterface $form_state) {
  $site_mail = $form_state->getValue('site_mail');
  ContactForm::load('feedback')->setRecipients([$site_mail])->trustData()->save();
}

 /**
  * Implements hook_views_plugins_row_alter().
  */
 function weeshop_views_plugins_row_alter(array &$plugins) {
     // Just expose the data entity row for entity views.
     foreach (\Drupal::entityTypeManager()->getDefinitions() as $entity_type_id => $entity_type) {
         $tables = array_filter([$entity_type->getBaseTable(), $entity_type->getDataTable(), $entity_type->getRevisionTable(), $entity_type->getRevisionDataTable()]);
         $plugins['data_entity']['base'] = isset($plugins['data_entity']['base']) ? $plugins['data_entity']['base'] : [];
         $plugins['data_entity']['base'] = array_merge($plugins['data_entity']['base'], $tables);
       }
 }

function weeshop_toolbar() {
  $items = [];
  $items['weeshop'] = [
    '#type' => 'toolbar_item',
    'tab' => [
      '#type' => 'link',
      '#title' => t('WeeShop'),
      '#url' => Url::fromRoute('<front>'),
      '#options' => [
        'attributes' => [
          'title' => t('WeeShop'),
          'class' => ['toolbar-item', 'toolbar-icon'],
          'id' => 'admin-logo'
        ],
      ],
    ],
    '#attached' => [
      'library' => [
        'weeshop/admin-logo',
      ],
    ],
    '#weight' => -90
  ];
  return $items;
}
