<?php

namespace Drupal\bootstrap\Plugin\Setting\General\Images;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "image_shape" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "image_shape",
 *   type = "select",
 *   title = @Translation("Default image shape"),
 *   description = @Translation("Add classes to an <code>&lt;img&gt;</code> element to easily style images in any project."),
 *   defaultValue = "",
 *   empty_option = @Translation("None"),
 *   groups = {
 *     "general" = @Translation("General"),
 *     "images" = @Translation("Images"),
 *   },
 *   options = {
 *     "img-rounded" = @Translation("Rounded"),
 *     "img-circle" = @Translation("Circle"),
 *     "img-thumbnail" = @Translation("Thumbnail"),
 *   },
 *   see = {
 *     "https://getbootstrap.com/docs/3.3/css/#images-shapes" = @Translation("Image Shapes"),
 *   },
 * )
 */
class ImageShape extends SettingBase {}
