<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\file\Entity\File;

/**
 * Pre-processes variables for the "file_link" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("file_link",
 *   replace = "template_preprocess_file_link"
 * )
 */
class FileLink extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    $options = [];

    $file = ($variables['file'] instanceof File) ? $variables['file'] : File::load($variables['file']->fid);
    $url = file_create_url($file->getFileUri());

    $file_size = $file->getSize();
    $mime_type = $file->getMimeType();

    // Set options as per anchor format described at
    // http://microformats.org/wiki/file-format-examples
    $options['attributes']['type'] = "$mime_type; length=$file_size";

    // Use the description as the link text if available.
    if (empty($variables['description'])) {
      $link_text = $file->getFilename();
    }
    else {
      $link_text = $variables['description'];
      $options['attributes']['title'] = $file->getFilename();
    }

    // Retrieve the generic mime type from core (mislabeled as "icon_class").
    $generic_mime_type = file_icon_class($mime_type);

    // Map the generic mime types to an icon and state.
    $mime_map = [
      'application-x-executable' => [
        'label' => t('binary file'),
        'icon' => 'console',
      ],
      'audio' => [
        'label' => t('audio file'),
        'icon' => 'headphones',
      ],
      'image' => [
        'label' => t('image'),
        'icon' => 'picture',
      ],
      'package-x-generic' => [
        'label' => t('archive'),
        'icon' => 'compressed',
      ],
      'text' => [
        'label' => t('document'),
        'icon' => 'file',
      ],
      'video' => [
        'label' => t('video'),
        'icon' => 'film',
      ],
    ];

    // Retrieve the mime map array.
    $mime = isset($mime_map[$generic_mime_type]) ? $mime_map[$generic_mime_type] : [
      'label' => t('file'),
      'icon' => 'file',
      'state' => 'primary',
    ];

    // Classes to add to the file field for icons.
    $variables->addClass([
      'file',
      // Add a specific class for each and every mime type.
      'file--mime-' . strtr($mime_type, ['/' => '-', '.' => '-']),
      // Add a more general class for groups of well known mime types.
      'file--' . $generic_mime_type,
    ]);

    // Set the icon for the mime type.
    $icon = Bootstrap::glyphicon($mime['icon']);
    $variables->icon = Element::create($icon)
      ->addClass('text-primary')
      ->getArray();

    $options['attributes']['title'] = t('Open @mime in new window', ['@mime' => $mime['label']]);
    $options['attributes']['target'] = '_blank';

    if ($this->theme->getSetting('tooltip_enabled')) {
      $options['attributes']['data-toggle'] = 'tooltip';
      $options['attributes']['data-placement'] = 'bottom';
    }
    $variables['link'] = Link::fromTextAndUrl($link_text, Url::fromUri($url, $options));

    // Add the file size as a variable.
    $variables->file_size = format_size($file_size);

    // Preprocess attributes.
    $this->preprocessAttributes();
  }

}
