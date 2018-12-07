<?php

/**
 * @file
 * Drupal Bootstrap Drush commands.
 */

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Theme;
use Drupal\Component\Serialization\Yaml;

/**
 * Implements hook_drush_command().
 */
function bootstrap_drush_command() {
  $items['bootstrap-generate-docs'] = [
    'description' => dt('Generates markdown documentation for the Drupal based code.'),
    'arguments' => [
      'type' => 'The specific type of documentation to generate, defaults to "all". Can be: "all", "settings".',
    ],
    'aliases' => ['bs-docs'],
  ];
  return $items;
}

/**
 * Generates markdown documentation.
 *
 * @param string $type
 *   The type of documentation.
 */
function drush_bootstrap_generate_docs($type = 'all') {
  $types = $type === 'all' ? ['settings'] : [$type];
  foreach ($types as $type) {
    $function = "_drush_bootstrap_generate_docs_$type";
    if (function_exists($function)) {
      $ret = $function(Bootstrap::getTheme('bootstrap'));
      if ($ret) {
        drush_log('Successfully generated documentation for: ' . $type, 'success');
      }
      else {
        drush_log('Unable to generate documentation for: ' . $type, 'error');
      }
    }
    else {
      drush_log('Invalid documentation type: ' . $type, 'error');
    }
  }
}

/**
 * Generates settings documentation.
 *
 * @param \Drupal\bootstrap\Theme $bootstrap
 *   The theme instance of the Drupal Bootstrap base theme.
 */
function _drush_bootstrap_generate_docs_settings(Theme $bootstrap) {
  $output[] = '<!-- @file Overview of theme settings for Drupal Bootstrap based themes. -->';
  $output[] = '<!-- @defgroup -->';
  $output[] = '<!-- @ingroup -->';
  $output[] = '# Theme Settings';
  $output[] = '';
  $output[] = 'To override a setting, open `./config/install/THEMENAME.settings.yml` and add the following:';
  $output[] = '';
  $output[] = '```yaml';
  $output[] = '# Settings';
  $output[] = '';
  $output[] = 'settings:';
  $output[] = '  SETTING_NAME: SETTING_VALUE';
  $output[] = '```';

  // Determine the groups.
  $groups = [];
  foreach ($bootstrap->getSettingPlugin() as $setting) {
    // Only get the first two groups (we don't need 3rd, or more, levels).
    $_groups = array_slice($setting->getGroups(), 0, 2, FALSE);
    if (!$_groups) {
      continue;
    }
    $groups[implode(' > ', $_groups)][] = $setting->getPluginDefinition();
  }

  // Generate a table of each group's settings.
  foreach ($groups as $group => $settings) {
    $output[] = '';
    $output[] = '---';
    $output[] = '';
    $output[] = "### $group";
    $output[] = '';
    $output[] = '<table class="table table-striped table-responsive">';
    $output[] = '  <thead>';
    $output[] = '    <tr>';
    $output[] = '      <th class="col-xs-3">Setting name</th>';
    $output[] = '      <th>Description and default value</th>';
    $output[] = '    </tr>';
    $output[] = '  </thead>';
    $output[] = '  <tbody>';
    foreach ($settings as $definition) {
      $output[] = '  <tr>';
      $output[] = '    <td class="col-xs-3">';
      $output[] = $definition['id'];
      $output[] = '    </td>';
      $output[] = '    <td>';
      $output[] = '      <div class="help-block">';
      $output[] = str_replace('&quote;', '"', wordwrap($definition['description']));
      $output[] = '      </div>';
      $output[] = '      <pre class=" language-yaml"><code>';
      $output[] = wordwrap(Yaml::encode([$definition['id'] => $definition['defaultValue']]));
      $output[] = '</code></pre>';
      $output[] = '    </td>';
      $output[] = '  </tr>';
    }
    $output[] = '  </tbody>';
    $output[] = '</table>';
  }

  // Ensure we have link references at the bottom.
  $output[] = '';
  $output[] = '[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap';
  $output[] = '[Bootstrap Framework]: https://getbootstrap.com/docs/3.3/';

  // Save the generated output to the appropriate file.
  return file_put_contents(realpath($bootstrap->getPath() . '/docs/Theme-Settings.md'), implode("\n", $output)) !== FALSE;
}
