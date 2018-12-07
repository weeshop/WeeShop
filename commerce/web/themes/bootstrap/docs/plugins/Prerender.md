<!-- @file Documentation for the @BootstrapPrerender annotated plugin. -->
<!-- @defgroup -->
<!-- @ingroup -->
# @BootstrapPrerender

- [Create a plugin](#create)
- [Rebuild the cache](#rebuild)

---

## Create a plugin {#create}

We'll use `Link` implemented by this base theme as an example of how to add
custom classes and an icon to make the link look like a Bootstrap button. This
example will only work if the link is passed some sort of `#context` when the
render array is built, like the following:

```php
<?php
$build['my_button'] = [
  '#type' => 'link',
  '#title' => t('Download'),
  '#url' => Url::fromUserInput('/download', [
    'query' => ['item' => '1234'],
  ]),
  '#context' => [
    'downloadButton' => TRUE,
  ],
];
?>
```

Replace all following instances of `THEMENAME` with the actual machine name of
your sub-theme.

Create a file at `./THEMENAME/src/Plugin/Prerender/Link.php` with the
following contents:

```php
<?php

namespace Drupal\THEMENAME\Plugin\Prerender;

use Drupal\bootstrap\Plugin\Prerender\Link as BootstrapLink;
use Drupal\bootstrap\Bootstrap;
use Drupal\bootstrap\Utility\Element;

/**
 * Pre-render callback for the "link" element type.
 *
 * @ingroup plugins_prerender
 *
 * @BootstrapPrerender("link",
 *   action = @BootstrapConstant(
 *     "\Drupal\bootstrap\Bootstrap::CALLBACK_PREPEND"
 *   )
 * )
 *
 * @see \Drupal\Core\Render\Element\Link::preRenderLink()
 */
class Link extends BootstrapLink {
  /*
   * It should be noted that you do not need both methods here.
   * This is to just show you the different examples of how this plugin
   * works and how it can be tailored to your needs.
   */

  /**
   * {@inheritdoc}
   */
  public static function preRender(array $element) {
    $context = isset($element['#context']) ? $element['#context'] : [];

    // Make downloadButton links into buttons.
    if (!empty($context['downloadButton'])) {
      $element['#icon'] = Bootstrap::glyphicon('download-alt');
      $element['#attributes']['class'][] = 'btn';
      $element['#attributes']['class'][] = 'btn-primary';
      $element['#attributes']['class'][] = 'btn-lg';
    }

    // You must always return the element in this method, as well as call the
    // parent method when sub-classing this method as it is used to invoke
    // static::preRenderElement().
    return parent::preRender($element);
  }

  /**
   * {@inheritdoc}
   */
  public static function preRenderElement(Element $element) {
    // Make downloadButton links into buttons.
    // Same as above, just a little cleaner with the Element utility class.
    if ($element->getContext('downloadButton')) {
      $element->addClass(['btn', 'btn-primary', 'btn-lg'])->setIcon(Bootstrap::glyphicon('download-alt'));
    }

    // You don't always have to call the parent method when sub-classing, but
    // it is generally recommended that you do (otherwise the icon that was
    // just added wouldn't work).
    parent::preRenderElement($element);
  }

}
?>
```

## Rebuild the cache {#rebuild}

Once you have saved, you must rebuild your cache for this new plugin to be
discovered. This must happen anytime you make a change to the actual file name
or the information inside the `@BootstrapPrerender` annotation.

To rebuild your cache, navigate to `admin/config/development/performance` and
click the `Clear all caches` button. Or if you prefer, run `drush cr` from the
command line.

Voilà! After this, you should have a fully functional `@BootstrapPrerender`
plugin!
