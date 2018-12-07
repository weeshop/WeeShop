<?php

namespace Drupal\bootstrap\Plugin\Process;

use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Processes the "search" element.
 *
 * @ingroup plugins_process
 *
 * @BootstrapProcess("search")
 */
class Search extends ProcessBase implements ProcessInterface {

  /**
   * {@inheritdoc}
   */
  public static function processElement(Element $element, FormStateInterface $form_state, array &$complete_form) {
    $element->setProperty('title_display', 'invisible');
    $element->setAttribute('placeholder', $element->getProperty('placeholder', $element->getProperty('title', t('Search'))));
    if (!$element->hasProperty('description')) {
      $element->setProperty('description', t('Enter the terms you wish to search for.'));
    }
  }

}
