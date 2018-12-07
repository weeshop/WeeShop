<?php

namespace Drupal\bootstrap\Plugin\Prerender;

/**
 * Pre-render callback for the "operations" element type.
 *
 * @ingroup plugins_prerender
 *
 * @BootstrapPrerender("operations",
 *   replace = "Drupal\Core\Render\Element\Operations::preRenderDropbutton"
 * )
 *
 * @see \Drupal\bootstrap\Plugin\Prerender\Dropbutton
 * @see \Drupal\Core\Render\Element\Operations::preRenderDropbutton()
 */
class Operations extends Dropbutton {}
