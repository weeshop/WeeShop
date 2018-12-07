<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "table" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("table")
 */
class Table extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    // Bordered.
    $variables['bordered'] = !!$variables->getContext('bordered', $this->theme->getSetting('table_bordered'));

    // Condensed.
    $variables['condensed'] = !!$variables->getContext('condensed', $this->theme->getSetting('table_condensed'));

    // Hover.
    $variables['hover'] = !!$variables->getContext('hover', $this->theme->getSetting('table_hover'));

    // Striped.
    $variables['striped'] = empty($variables['no_striping']) && $variables->getContext('striped', $this->theme->getSetting('table_striped'));
    unset($variables['no_striping']);

    // Responsive.
    $responsive = $variables->getContext('responsive', $this->theme->getSetting('table_responsive'));
    $variables['responsive'] = $responsive == -1 ? !\Drupal::service('router.admin_context')->isAdminRoute() : !!(int) $responsive;
  }

}
