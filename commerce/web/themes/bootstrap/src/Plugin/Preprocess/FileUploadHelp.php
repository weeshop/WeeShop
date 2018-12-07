<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldFilteredMarkup;
use Drupal\Core\Url;

/**
 * Pre-processes variables for the "file_upload_help" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("file_upload_help",
 *   replace = "template_preprocess_file_upload_help"
 * )
 */
class FileUploadHelp extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    if (!empty($variables['description'])) {
      $variables['description'] = FieldFilteredMarkup::create($variables['description']);
    }

    $descriptions = [];

    $cardinality = $variables['cardinality'];
    if (isset($cardinality)) {
      if ($cardinality == -1) {
        $descriptions[] = t('Unlimited number of files can be uploaded to this field.');
      }
      else {
        $descriptions[] = \Drupal::translation()->formatPlural($cardinality, 'One file only.', 'Maximum @count files.');
      }
    }

    $upload_validators = $variables['upload_validators'];
    if (isset($upload_validators['file_validate_size'])) {
      $descriptions[] = t('@size limit.', ['@size' => format_size($upload_validators['file_validate_size'][0])]);
    }
    if (isset($upload_validators['file_validate_extensions'])) {
      $extensions = new FormattableMarkup('<code>@extensions</code>', [
        '@extensions' => implode(', ', explode(' ', $upload_validators['file_validate_extensions'][0])),
      ]);
      $descriptions[] = t('Allowed types: @extensions.', ['@extensions' => $extensions]);
    }

    if (isset($upload_validators['file_validate_image_resolution'])) {
      $max = $upload_validators['file_validate_image_resolution'][0];
      $min = $upload_validators['file_validate_image_resolution'][1];
      if ($min && $max && $min == $max) {
        $descriptions[] = t('Images must be exactly <strong>@size</strong> pixels.', ['@size' => $max]);
      }
      elseif ($min && $max) {
        $descriptions[] = t('Images must be larger than <strong>@min</strong> pixels. Images larger than <strong>@max</strong> pixels will be resized.', ['@min' => $min, '@max' => $max]);
      }
      elseif ($min) {
        $descriptions[] = t('Images must be larger than <strong>@min</strong> pixels.', ['@min' => $min]);
      }
      elseif ($max) {
        $descriptions[] = t('Images larger than <strong>@max</strong> pixels will be resized.', ['@max' => $max]);
      }
    }

    $variables['descriptions'] = $descriptions;

    if ($descriptions && $this->theme->getSetting('popover_enabled')) {
      $build = [];
      $id = Html::getUniqueId('upload-instructions');
      $build['toggle'] = [
        '#type' => 'link',
        '#title' => t('Upload requirements'),
        '#url' => Url::fromUserInput("#$id"),
        '#icon' => Bootstrap::glyphicon('question-sign'),
        '#attributes' => [
          'class' => ['icon-before'],
          'data-toggle' => 'popover',
          'data-html' => 'true',
          'data-placement' => 'bottom',
          'data-title' => t('Upload requirements'),
        ],
      ];
      $build['requirements'] = [
        '#type' => 'container',
        '#theme_wrappers' => ['container__file_upload_help'],
        '#attributes' => [
          'id' => $id,
          'class' => ['hidden', 'help-block'],
          'aria-hidden' => 'true',
        ],
      ];
      $build['requirements']['descriptions'] = [
        '#theme' => 'item_list__file_upload_help',
        '#items' => $descriptions,
      ];
      $variables['popover'] = $build;
    }
  }

}
