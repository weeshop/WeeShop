<!-- @file Documentation for the @BootstrapAlter annotated plugin. -->
<!-- @defgroup -->
<!-- @ingroup -->
# @BootstrapAlter

- [Pre-requisite](#prerequisite)
- [Supported alter hooks](#supported)
- [Form alter hooks](#form)
- [Create a plugin](#create)
- [Rebuild the cache](#rebuild)

---

## Pre-requisite {#prerequisite}

Due to the nature of how Drupal alter hooks work, there is no "catch all" alter
hook (like for forms with hook_form_alter). That means for you to use this
plugin, it must be invoked from inside each and every alter hook that lives in
`THEMENAME.theme`.

Luckily you don't have to worry about invoking the plugin directly. Instead,
all you have to do is call the `Bootstrap::alter` helper method and pass the
alter function name and parameters as arguments:

```php
<?php
use Drupal\bootstrap\Bootstrap;

/**
 * Implements hook_HOOK_alter().
 */
function hook_some_hook_alter(&$data, &$context1 = NULL, &$context2 = NULL) {
  Bootstrap::alter(__FUNCTION__, $data, $context1, $context2);
}

?>
```

## Supported alter hooks {#supported}

This base theme implements several of the most commonly used alter hooks in
themes and are automatically supported out-of-the-box.

Once a base theme has implemented an alter hook, like mentioned above, all
subsequent sub-themes will have the ability to implement a plugin for that
alter hook directly. All you have to do is simply create the plugin file in
`./THEMENAME/src/Plugin/Alter`. No need to implement any code in
`THEMENAME.theme`:

- `hook_bootstrap_colorize_text_alter`
- `hook_bootstrap_iconize_text_alter`
- `hook_element_info_alter`
- `hook_js_settings_alter`
- `hook_library_info_alter`
- `hook_page_attachments_alter`
- `hook_theme_registry_alter`
- `hook_theme_suggestions_alter`

{.alert.alert-info}**Note:** if you do not see an alter hook here that you think
_should_ be here, please
[create an issue](https://www.drupal.org/node/add/project-issue/bootstrap)

## Form alter hooks {#form}

You were probably thinking: "Hey, where's `hook_form_alter`? Didn't you _just_
mention that above?"

As we all know, forms can be a tad more involved than just a simple "alter" and
we figured that we'd give you a little more power behind what you can actually
do with them. So if you're interested in those, please go see:

@link plugins_form @BootstrapForm @endlink

While, yes technically, `hook_form_system_theme_settings_alter` could also fall
under the form plugin, we decided to take those a step further as well, see:


@link plugins_setting @BootstrapSetting @endlink

## Create a plugin {#create}

We'll use `PageAttachments` implemented by this base theme as an example of
how to add a library from your sub-theme to every page request.

Replace all following instances of `THEMENAME` with the actual machine name of
your sub-theme.

Create a file at `./THEMENAME/src/Plugin/Alter/PageAttachments.php` with the
following contents:

```php
<?php
/**
 * @file
 * Contains \Drupal\THEMENAME\Plugin\Alter\PageAttachments.
 */

namespace Drupal\THEMENAME\Plugin\Alter;

use Drupal\bootstrap\Plugin\Alter\PageAttachments as BootstrapPageAttachements;

/**
 * Implements hook_page_attachments_alter().
 *
 * @ingroup plugins_alter
 *
 * @BootstrapAlter("page_attachments")
 */
class PageAttachments extends BootstrapPageAttachements {

  /**
   * {@inheritdoc}
   */
  public function alter(&$attachments, &$context1 = NULL, &$context2 = NULL) {
    // Call the parent method from the base theme, if applicable (which it is
    // in this case because Bootstrap actually implements this alter).
    parent::alter($attachments, $context1, $context2);

    // Add your custom library.
    $attachments['#attached']['library'][] = 'THEMENAME/my_library';
  }

}
?>
```

## Rebuild the cache {#rebuild}

Once you have saved, you must rebuild your cache for this new plugin to be
discovered. This must happen anytime you make a change to the actual file name
or the information inside the `@BootstrapAlter` annotation.

To rebuild your cache, navigate to `admin/config/development/performance` and
click the `Clear all caches` button. Or if you prefer, run `drush cr` from the
command line.

Voilà! After this, you should have a fully functional `@BootstrapAlter` plugin!
