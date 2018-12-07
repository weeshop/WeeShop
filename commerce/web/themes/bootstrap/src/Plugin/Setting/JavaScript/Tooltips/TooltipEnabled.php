<?php

namespace Drupal\bootstrap\Plugin\Setting\JavaScript\Tooltips;

use Drupal\bootstrap\Plugin\Setting\SettingBase;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * The "tooltip_enabled" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "tooltip_enabled",
 *   type = "checkbox",
 *   title = @Translation("Enable Bootstrap Tooltips"),
 *   description = @Translation("Elements that have the <code>data-toggle=&quote;tooltip&quote;</code> attribute set will automatically initialize the tooltip upon page load. <strong class='error text-error'>WARNING: This feature can sometimes impact performance. Disable if pages appear to &quote;hang&quote; after initial load.</strong>"),
 *   defaultValue = 1,
 *   weight = -1,
 *   groups = {
 *     "javascript" = @Translation("JavaScript"),
 *     "tooltips" = @Translation("Tooltips"),
 *   },
 * )
 */
class TooltipEnabled extends SettingBase {

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    parent::alterFormElement($form, $form_state, $form_id);

    $group = $this->getGroupElement($form, $form_state);
    $group->setProperty('description', t('Inspired by the excellent jQuery.tipsy plugin written by Jason Frame; Tooltips are an updated version, which don\'t rely on images, use CSS3 for animations, and data-attributes for local title storage. See <a href=":url" target="_blank">Bootstrap tooltips</a> for more documentation.', [
      ':url' => 'https://getbootstrap.com/docs/3.3/javascript/#tooltips',
    ]));
  }

  /**
   * {@inheritdoc}
   */
  public function drupalSettings() {
    return !!$this->theme->getSetting('tooltip_enabled');
  }

}
