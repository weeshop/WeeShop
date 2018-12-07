<?php

namespace Drupal\bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Utility\Attributes;
use Drupal\bootstrap\Utility\Variables;
use Drupal\Core\Template\Attribute;
use Drupal\Core\Url;

/**
 * Pre-processes variables for the "menu" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("menu")
 */
class Menu extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  protected function preprocessVariables(Variables $variables) {
    foreach ($variables->items as &$item) {
      $wrapperAttributes = new Attributes();
      $linkAttributes = new Attributes();
      if ($item['attributes'] instanceof Attribute || $item['attributes'] instanceof Attributes) {
        $wrapperAttributes->setAttributes($item['attributes']->getIterator()->getArrayCopy());
      }
      if ($item['url'] instanceof Url) {
        $wrapperAttributes->setAttributes($item['url']->getOption('wrapper_attributes') ?: []);
        $wrapperAttributes->setAttributes($item['url']->getOption('container_attributes') ?: []);
        $linkAttributes->setAttributes($item['url']->getOption('attributes') ?: []);
      }

      // Unfortunately, in newer core/Twig versions, only certain classes are
      // allowed to be invoked due to stricter sandboxing policies. To get
      // around this, just rewrap attributes in core's native Attribute class.
      $item['attributes'] = new Attribute($wrapperAttributes->getArrayCopy());
      $item['link_attributes'] = new Attribute($linkAttributes->getArrayCopy());
    }
  }

}
