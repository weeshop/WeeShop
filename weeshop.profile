<?php

/**
 * @file
 * Enables modules and site configuration for a commerce_base site installation.
 */

use Drupal\contact\Entity\ContactForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements hook_install_tasks().
 */
function weeshop_install_tasks(&$install_state) {
  $tasks = [
    '_weeshop_final_site_setup' => [
      'display_name' => t('Data Importing'),
      'type' => 'batch',
      'display' => TRUE,
    ]
  ];
  return $tasks;
}

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function weeshop_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {
  // Add a placeholder as example that one can choose an arbitrary site name.
  $form['site_information']['site_name']['#attributes']['placeholder'] = t('Your WeeShop site name');
  // Add 'Social' fieldset and options.
  $form['weeshop'] = [
    '#type' => 'fieldgroup',
    '#title' => t('WeeShop Demo data'),
    '#description' => t('If you want to have demo data within your new site, please check the yes.'),
    '#weight' => 50,
  ];

  // Checkboxes to generate demo content.
  $form['weeshop']['demo_content'] = [
    '#type' => 'checkbox',
    '#title' => t('Generate demo content'),
    '#description' => t('Will generate files, products, adverts.'),
  ];

  $form['#submit'][] = 'weeshop_form_install_configure_submit';
}

/**
 * Submission handler to sync the contact.form.feedback recipient.
 */
function weeshop_form_install_configure_submit($form, FormStateInterface $form_state) {
  \Drupal::state()->set('weeshop_install_demo_content', $form_state->getValue('demo_content'));
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


function _weeshop_final_site_setup(array &$install_state) {
  \Drupal::logger('weeshop_demo')->notice('已经执行了 _weeshop_final_site_setup()');
  $batch_operations = [];
  $demo_content = \Drupal::state()->get('weeshop_install_demo_content');
  \Drupal::logger('weeshop_demo')->notice('$demo_content的取值为：'.$demo_content);
  if ($demo_content === 1) {
    $batch_operations[] = ['_weeshop_demo_execute_migrations', ['import']];
  }

  return [
    'title' => t('正在导入数据'),
    'operations' => $batch_operations
  ];
}
