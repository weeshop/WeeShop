<!-- @file Documents the Plugin System for the Drupal Bootstrap base theme. -->
<!-- @defgroup -->
<!-- @ingroup -->
# Plugin System

- [Overview](#overview)
- [Helpful Tips](#helpful-tips)

---

## Overview {#overview}

The [Drupal Bootstrap] base theme handles some very complex theme registry
alterations and annotated plugin discoveries to assist with the organization
and maintenance of its source code.

By leveraging OOP (object oriented programming) with PHP namespacing and
Drupal's autoloading, we garner the ability to include files only when a
theme hook is actually invoked. This allows the base theme to reduce its per
page PHP memory footprint as much as possible. It also allows for easier
maintenance and organization with as much customization this base theme
implements.

The data and display logic of the [Drupal Bootstrap] base theme has been
divided into what we call the "Plugin System". It's nearly identical to the
other plugin system(s) found through out Drupal, with the exception that these
plugins are not bound to the container in any way.

This is, in part, due to the fact that themes are not allowed to participate in
container construction since a theme could vary from page to page (in theory).
So, instead, this base theme implements its own annotated discovery plugins
to leverage the powerful inheritance capabilities of PHP class instances.

All of these plugins can be found in the following directories and are
discussed, in length, below in their respective sub-topics:
- `./bootstrap/src/Plugin/Alter`
- `./bootstrap/src/Plugin/Form`
- `./bootstrap/src/Plugin/Preprocess`
- `./bootstrap/src/Plugin/Prerender`
- `./bootstrap/src/Plugin/Process`
- `./bootstrap/src/Plugin/Provider`
- `./bootstrap/src/Plugin/Setting`
- `./bootstrap/src/Plugin/Update`

While sub-themes are not required to do so, they can easily emulate this same
type of file structure/workflow and take advantage of this base theme's unique
ability and power. All you have to do is make sure you extend from this base
theme's implementation, if it exists.

Rest assured though, there is no need to structure your sub-theme this way. If
you feel more comfortable storing everything in your sub-theme's
`THEMENAME.theme` file and invoking the "normal" Drupal hooks, please feel free
to do so. It will not impact your sub-theme one way or the other.

It is, however, highly recommended that you at least read through this a bit to
gain some understanding on how this base theme structures its PHP and template
components. This will allow you to more easily copy stuff over to your
sub-theme, should the need arise.

## Helpful tips {#helpful-tips}

All plugins, except those that only have static methods, have the active Theme
object available to them: e.g. `$this->theme`. This will allow you to do things
like get a theme setting very, very easily: e.g.
`$this->theme->getSetting('button_size')`.

A helpful primer on Annotation-based plugins can be found at:
https://www.drupal.org/node/1882526

[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap
