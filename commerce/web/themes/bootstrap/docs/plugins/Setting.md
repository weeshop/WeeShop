<!-- @file Documentation for the @BootstrapSetting annotated plugin. -->
<!-- @defgroup -->
<!-- @ingroup -->
# @BootstrapSetting

- [Create a plugin](#create)
- [Rebuild the cache](#rebuild)
- [Public Methods](#methods)

## Create a plugin {#create}

We will use `SkipLink` as our first `@BootstrapSetting` plugin to create. In
this example we want our sub-theme to specify a different skip link anchor id
to change in the Theme Settings interface altering the default of
`#main-content`.

Replace all of the following instances of `THEMENAME` with the actual machine
name of your sub-theme.

Create a file at
`./THEMENAME/src/Plugin/Setting/THEMENAME/Accessibility/SkipLink.php`
with the following contents:

```php
<?php
namespace Drupal\THEMENAME\Plugin\Setting\THEMENAME\Accessibility;

use Drupal\bootstrap\Plugin\Setting\SettingBase;

/**
 * The "THEMENAME_skip_link_id" theme setting.
 *
 * @ingroup plugins_setting
 *
 * @BootstrapSetting(
 *   id = "THEMENAME_skip_link_id",
 *   type = "textfield",
 *   title = @Translation("Anchor ID for the ""skip link"""),
 *   defaultValue = "main-content",
 *   description = @Translation("Specify the HTML ID of the element that the accessible-but-hidden ""skip link"" should link to. (<a href="":link"" target=""_blank"">Read more about skip links</a>.)",
 *   arguments = { ":link"  = "https://www.drupal.org/node/467976" }),
 *   groups = {
 *     "THEMENAME" = "THEMETITLE",
 *     "accessibility" = @Translation("Accessibility"),
 *   },
 * )
 */
class SkipLink extends SettingBase {}
?>
```

Helpfully Bootstrap adds a global `theme` variable added to every template
in `Bootstrap::preprocess()`.

This variable can now simply be called in the `html.html.twig` file with the
following contents:

```twig
<a href="#{{ theme.settings.THEMENAME_skip_link_id }}"
  class="visually-hidden focusable skip-link">
  {{ 'Skip to main content'|t }}
</a>
```

In addition, the `page.html.twig` file will also need to be adjusted for this to
work properly with the new anchor id.

```twig
<a id="{{ theme.settings.THEMENAME_skip_link_id }}"></a>
```

## Rebuild the cache {#rebuild}

Once you have saved, you must rebuild your cache for this new plugin to be
discovered. This must happen anytime you make a change to the actual file name
or the information inside the `@BootstrapSetting` annotation.

To rebuild your cache, navigate to `admin/config/development/performance` and
click the `Clear all caches` button. Or if you prefer, run `drush cr` from the
command line.

Voilà! After this, you should have a fully functional `@BootstrapSetting`
plugin!

## Public Methods {#methods}

Now that we covered how to create a basic `@BootstrapSetting` plugin, we can
discuss how to customize a setting to fulfill a range of requirements.

The `@BootstrapSetting` is implemented through the base class `SettingBase`
which provides a variety of public methods to assist in the customization of
a plugin.

#### SettingBase::alterForm(array &$form, FormStateInterface $form_state, $form_id = NULL)
#### SettingBase::alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL)

Both of these methods provide a way for you to alter the setting's form render
array element as well as the form state object.

The first method is similar to any standard `hook_form_alter`.

However, the second method passes the `$form` argument as an instance of the
`Element` utility helper class. This will allow easier manipulation of all the
elements in this method. Using this method is preferable and considered
"Best Practice".

Two useful examples to study:

- CDNProvider::alterFormElement
- RegionWells::alterFormElement

#### SettingBase::drupalSettings()

This method provides a way for you to determine whether a theme setting should
be added to the `drupalSettings` JavaScript variable. Please note that by
default this is set to `FALSE` to prevent any potentially sensitive information
from being leaked.

#### SettingBase::getCacheTags()

This method provides a way for you to add cache tags that when the instantiated
class is modified the associated cache tags will be invalidated. This is
incredibly useful for example with CDNCustomCss::getCacheTags() which returns an
array of `library_info`. So when a CdnProvider::getCacheTags() instantiated
plugin changes the `library_info` cache tag will be invalidated automatically.

It is important to note that the invalidation occurs because the base theme
loads external resources using libraries by altering the libraries it defines
based on settings in LibraryInfo::alter().

#### SettingBase::getGroupElement(Element $form, FormStateInterface $form_state)

This method provides a way for you to retrieve the last group (fieldset /
details form element) the setting is nested in; based on the plugin definition.

#### SettingBase::getGroups()

This method retrieves the associative array of groups; based on the plugin
definition. It's keyed by the group machine name and its value is the
translatable label.

#### SettingBase::getSettingElement(Element $form, FormStateInterface $form_state)

This method provides a way for you to retrieve the form element that was
automatically generated by the base theme for the setting; based on the plugin
definition.

#### SettingBase::submitForm(array &$form, FormStateInterface $form_state)
#### SettingBase::submitFormElement(Element $form, FormStateInterface $form_state)

Both of these methods provide a way for you to alter the submitted values
stored in the form state object before the setting's value is ultimately stored
in configuration by the base theme, which is performed automatically for you.

Two useful example to study:

- RegionWells::submitFormElement

#### SettingBase::validateForm(array &$form, FormStateInterface $form_state)
#### SettingBase::validateFormElement(Element $form, FormStateInterface $form_state)

Both of these methods provide a way for you to validate the setting's form.
