<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "tablesort_indicator" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("tablesort_indicator")
 */
class TableSortIndicator extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessVariables(Variables $variables) {
    if ($variables->style === 'asc') {
      $icon = Element::createStandalone(Bootstrap::glyphicon('chevron-down', ['#markup' => $this->t('(asc)')]))
        ->addClass('icon-after')
        ->setAttributes([
          'data-toggle' => 'tooltip',
          'data-placement' => 'bottom',
          'title' => $this->t('Sort ascending'),
        ]);
    }
    else {
      $icon = Element::createStandalone(Bootstrap::glyphicon('chevron-up', ['#markup' => $this->t('(desc)')]))
        ->addClass('icon-after')
        ->setAttributes([
          'data-toggle' => 'tooltip',
          'data-placement' => 'bottom',
          'title' => $this->t('Sort descending'),
        ]);
    }
    $variables->icon = $icon->getArray();
  }

}
