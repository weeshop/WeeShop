<?php

namespace Drupal\bootstrap\Plugin\Form;

use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @ingroup plugins_form
 *
 * @BootstrapForm("node_preview_form_select")
 */
class NodePreviewFormSelect extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    $form->addClass(['form-inline', 'bg-info', 'text-center', 'clearfix']);

    // Backlink.
    $options = $form->backlink->getProperty('options', []);

    $form->backlink->addClass(isset($options['attributes']['class']) ? $options['attributes']['class'] : []);
    $form->backlink->addClass(['btn', 'btn-info', 'pull-left']);
    $form->backlink->setButtonSize();
    $form->backlink->setIcon(Bootstrap::glyphicon('chevron-left'));

    // Ensure the UUID is set.
    if ($uuid = $form->uuid->getProperty('value')) {
      $options['query'] = ['uuid' => $uuid];
    }

    // Override the options attributes.
    $options['attributes'] = $form->backlink->getAttributes()->getArrayCopy();

    $form->backlink->setProperty('options', $options);

    // View mode.
    $form->view_mode->addClass('pull-right', $form::WRAPPER);
  }

}
