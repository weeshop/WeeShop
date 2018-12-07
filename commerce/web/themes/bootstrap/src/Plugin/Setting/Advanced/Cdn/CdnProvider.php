<?php

namespace Drupal\bootstrap\Plugin\Setting\Advanced\Cdn;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Plugin\Provider\ProviderInterface;
use Drupal\bootstrap\Plugin\ProviderManager;
use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Traits\FormAutoloadFixTrait;
use Drupal\bootstrap\Utility\Element;
use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "cdn_provider" theme setting.
 *
 * @ingroup plugins_provider
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "cdn_provider",
 *   type = "select",
 *   title = @Translation("CDN Provider"),
 *   description = @Translation("Choose between jsdelivr or a custom cdn source."),
 *   defaultValue = "jsdelivr",
 *   empty_value = "",
 *   weight = -1,
 *   groups = {
 *     "advanced" = @Translation("Advanced"),
 *     "cdn" = @Translation("CDN (Content Delivery Network)"),
 *   },
 *   options = { },
 * )
 */
class CdnProvider extends SettingBase {

  use FormAutoloadFixTrait;

  /**
   * The current provider.
   *
   * @var \Drupal\bootstrap\Plugin\Provider\ProviderInterface
   */
  protected $provider;

  /**
   * The current provider manager instance.
   *
   * @var \Drupal\bootstrap\Plugin\ProviderManager
   */
  protected $providerManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->providerManager = new ProviderManager($this->theme);
    if (isset($plugin_definition['cdn_provider'])) {
      $this->provider = $this->theme->getProvider($plugin_definition['cdn_provider']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    // Add autoload fix to make sure AJAX callbacks work.
    static::formAutoloadFix($form_state);

    // Retrieve the provider from form values or the setting.
    $default_provider = $form_state->getValue('cdn_provider', $this->theme->getSetting('cdn_provider'));

    $group = $this->getGroupElement($form, $form_state);
    $description_label = $this->t('NOTE');
    $description = $this->t('Using one of the "CDN Provider" options below is the preferred method for loading Bootstrap CSS and JS on simpler sites that do not use a site-wide CDN. Using a "CDN Provider" for loading Bootstrap, however, does mean that it depends on a third-party service. There is no obligation or commitment by these third-parties that guarantees any up-time or service quality. If you need to customize Bootstrap and have chosen to compile the source code locally (served from this site), you must disable the "CDN Provider" option below by choosing "- None -" and alternatively enable a site-wide CDN implementation. All local (served from this site) versions of Bootstrap will be superseded by any enabled "CDN Provider" below. <strong>Do not do both</strong>.');
    $group->setProperty('description', '<div class="alert alert-info messages warning"><strong>' . $description_label . ':</strong> ' . $description . '</div>');
    $group->setProperty('open', !!$default_provider);

    // Intercept possible manual import of API data via AJAX callback.
    $this->importProviderData($form_state);

    $providers = $this->theme->getProviders();

    $options = [];
    foreach ($providers as $plugin_id => $provider) {
      $options[$plugin_id] = $provider->getLabel();
      $this->createProviderGroup($group, $provider);
    }

    // Override the options with the provider manager discovery.
    $setting = $this->getSettingElement($form, $form_state);
    $setting->setProperty('options', $options);
  }

  /**
   * AJAX callback for reloading CDN provider elements.
   *
   * @param array $form
   *   Nested array of form elements that comprise the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public static function ajaxCallback(array $form, FormStateInterface $form_state) {
    return $form['advanced']['cdn'][$form_state->getValue('cdn_provider', Bootstrap::getTheme()->getSetting('cdn_provider'))];
  }

  /**
   * Creates the necessary containers for each provider.
   *
   * @param \Drupal\bootstrap\Utility\Element $group
   *   The group element instance.
   * @param \Drupal\bootstrap\Plugin\Provider\ProviderInterface $provider
   *   The provider instance.
   */
  private function createProviderGroup(Element $group, ProviderInterface $provider) {
    $plugin_id = Html::cleanCssIdentifier($provider->getPluginId());

    // Create the provider container.
    $group->$plugin_id = [
      '#type' => 'container',
      '#prefix' => '<div id="cdn-provider-' . $plugin_id . '">',
      '#suffix' => '</div>',
      '#states' => [
        'visible' => [
          ':input[name="cdn_provider"]' => ['value' => $plugin_id],
        ],
      ],
    ];

    // Add in the provider description.
    if ($description = $provider->getDescription()) {
      $group->$plugin_id->description = [
        '#markup' => '<div class="lead">' . $description . '</div>',
        '#weight' => -99,
      ];
    }

    // Indicate there was an error retrieving the provider's API data.
    if ($provider->hasError() || $provider->isImported()) {
      if ($provider->hasError()) {
        $description_label = $this->t('ERROR');
        $description = $this->t('Unable to reach or parse the data provided by the @title API. Ensure the server this website is hosted on is able to initiate HTTP requests. If the request consistently fails, it is likely that there are certain PHP functions that have been disabled by the hosting provider for security reasons. It is possible to manually copy and paste the contents of the following URL into the "Imported @title data" section below.<br /><br /><a href=":provider_api" target="_blank">:provider_api</a>.', [
          '@title' => $provider->getLabel(),
          ':provider_api' => $provider->getApi(),
        ]);
        $group->$plugin_id->error = [
          '#markup' => '<div class="alert alert-danger messages error"><strong>' . $description_label . ':</strong> ' . $description . '</div>',
          '#weight' => -20,
        ];
      }

      $group->$plugin_id->import = [
        '#type' => 'details',
        '#title' => t('Imported @title data', ['@title' => $provider->getLabel()]),
        '#description' => t('The provider will attempt to parse the data entered here each time it is saved. If no data has been entered, any saved files associated with this provider will be removed and the provider will again attempt to request the API data normally through the following URL: <a href=":provider_api" target="_blank">:provider_api</a>.', [
          ':provider_api' => $provider->getPluginDefinition()['api'],
        ]),
        '#weight' => 10,
        '#open' => FALSE,
      ];

      $group->$plugin_id->import->cdn_provider_import_data = [
        '#type' => 'textarea',
        '#default_value' => file_exists(ProviderManager::FILE_PATH . '/' . $plugin_id . '.json') ? file_get_contents(ProviderManager::FILE_PATH . '/' . $plugin_id . '.json') : NULL,
      ];

      $group->$plugin_id->import->submit = [
        '#type' => 'submit',
        '#value' => t('Save provider data'),
        '#executes_submit_callback' => FALSE,
        '#ajax' => [
          'callback' => [get_class($this), 'ajaxCallback'],
          'wrapper' => 'cdn-provider-' . $plugin_id,
        ],
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return ['library_info'];
  }

  /**
   * Imports data for a provider that was manually uploaded in theme settings.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  private function importProviderData(FormStateInterface $form_state) {
    if ($form_state->getValue('clicked_button') === t('Save provider data')->render()) {
      $provider_path = ProviderManager::FILE_PATH;
      file_prepare_directory($provider_path, FILE_CREATE_DIRECTORY | FILE_MODIFY_PERMISSIONS);

      $provider = $form_state->getValue('cdn_provider', $this->theme->getSetting('cdn_provider'));
      $file = "$provider_path/$provider.json";

      if ($import_data = $form_state->getValue('cdn_provider_import_data', FALSE)) {
        file_unmanaged_save_data($import_data, $file, FILE_EXISTS_REPLACE);
      }
      elseif ($file && file_exists($file)) {
        file_unmanaged_delete($file);
      }

      // Clear the cached definitions so they can get rebuilt.
      $this->providerManager->clearCachedDefinitions();
    }
  }

}
