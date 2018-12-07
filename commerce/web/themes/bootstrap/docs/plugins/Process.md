<!-- @file Documentation for the @BootstrapProcess annotated plugin. -->
<!-- @defgroup -->
<!-- @ingroup -->
# @BootstrapProcess

- [Create a plugin](#create)
- [Rebuild the cache](#rebuild)

---

## Create a plugin {#create}

{.alert.alert-warning}**Note:** This plugin is _not_ a re-implementation of the
D7 `hook_process_HOOK` for theme hooks in anyway. That layer was removed from
the theme system in D8 and for good reason (see:
[Remove the process layer](https://www.drupal.org/node/1843650)). This plugin
is about automatically adding a `#process` callback for a form element `#type`.
This is especially useful when dealing with core elements that have implemented
their own callbacks; either to alter their output or remove entirely.

We'll use `TextFormat` implemented by this base theme as an example of how to
override the class entirely and remove this base theme's over-simplification
for the "format tips" section.

Replace all following instances of `THEMENAME` with the actual machine name of
your sub-theme.

Create a file at `./THEMENAME/src/Plugin/Process/TextFormat.php` with the
following contents:

```php
<?php

namespace Drupal\THEMENAME\Plugin\Process;

use Drupal\bootstrap\Plugin\Process\TextFormat as BootstrapTextFormat;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Processes the "text_format" element.
 *
 * @ingroup plugins_process
 *
 * @BootstrapProcess("text_format")
 *
 * @see \Drupal\filter\Element\TextFormat::processFormat()
 */
class TextFormat extends BootstrapTextFormat {
  /*
   * It should be noted that you do not need both methods here.
   * This is to just show you the different examples of how this plugin
   * works and how it can be tailored to your needs.
   */

  /**
   * {@inheritdoc}
   */
  public static function process(array $element, FormStateInterface $form_state, array &$complete_form) {
    // You must return the element immediately if this is TRUE.
    if (!empty($element['#bootstrap_ignore_process'])) {
      return $element;
    }

    // Technically this isn't the method that we need to achieve our goal.
    // But showing it just for example sake.
    //
    // You must always return the element in this method, as well as call the
    // parent method when sub-classing this method as it is used to invoke
    // static::processElement();
    return parent::process($element, $form_state, $complete_form);
  }

  /**
   * {@inheritdoc}
   */
  public static function processElement(Element $element, FormStateInterface $form_state, array &$complete_form) {
    // Normally, we'd call the parent method here. But this is actually an
    // instance where we know we don't want to use the alterations made by
    // the base theme. So we just comment it out and leave the method empty.
    // parent::processElement($element, $form_state, $complete_form);.
  }

}
?>
```

## Rebuild the cache {#rebuild}

Once you have saved, you must rebuild your cache for this new plugin to be
discovered. This must happen anytime you make a change to the actual file name
or the information inside the `@BootstrapProcess` annotation.

To rebuild your cache, navigate to `admin/config/development/performance` and
click the `Clear all caches` button. Or if you prefer, run `drush cr` from the
command line.

Voilà! After this, you should have a fully functional `@BootstrapProcess`
plugin!
