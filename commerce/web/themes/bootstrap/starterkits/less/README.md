<!-- @file Instructions for subtheming using the Less Starterkit. -->
<!-- @defgroup sub_theming_less -->
<!-- @ingroup sub_theming -->
# Less Starterkit

Below are instructions on how to create a Bootstrap sub-theme using a Less
preprocessor.

- [Prerequisites](#prerequisites)
- [Additional Setup](#setup)
- [Overrides](#overrides)

## Prerequisites
- Read the @link getting_started Getting Started @endlink and
  @link sub_theming Sub-theming @endlink documentation topics.
- You must understand the basic concept of using the [Less] CSS pre-processor.
- You must use a **[local Less compiler](https://www.google.com/search?q=less+compiler)**.
- You must use the [Bootstrap Framework Source Files] ending in the `.less`
  extension, not files ending in `.css`.

## Additional Setup {#setup}
Download and extract the **latest** 3.x.x version of
[Bootstrap Framework Source Files] into the root of your new sub-theme. After
it has been extracted, the directory should be renamed (if needed) so it reads
`./THEMENAME/bootstrap`.

If for whatever reason you have an additional `bootstrap` directory wrapping the
first `bootstrap` directory (e.g. `./THEMENAME/bootstrap/bootstrap`), remove the
wrapping `bootstrap` directory. You will only ever need to touch these files if
or when you upgrade your version of the [Bootstrap Framework].

{.alert.alert-warning} **WARNING:** Do not modify the files inside of
`./THEMENAME/bootstrap` directly. Doing so may cause issues when upgrading the
[Bootstrap Framework] in the future.

## Overrides {#overrides}
The `./THEMENAME/less/variable-overrides.less` file is generally where you will
the majority of your time overriding the variables provided by the [Bootstrap
Framework].

The `./THEMENAME/less/bootstrap.less` file is nearly an exact copy from the
[Bootstrap Framework Source Files]. The only difference is that it injects the
`variable-overrides.less` file directly after it has imported the [Bootstrap
Framework]'s `variables.less` file. This allows you to easily override variables
without having to constantly keep up with newer or missing variables during an
upgrade.

The `./THEMENAME/less/overrides.less` file contains various Drupal overrides to
properly integrate with the [Bootstrap Framework]. It may contain a few
enhancements, feel free to edit this file as you see fit.

The `./THEMENAME/less/style.less` file is the glue that combines the
[Bootstrap Framework Source Files] and `overrides.less` files together.
Generally, you will not need to modify this file unless you need to add or
remove files to be imported. This is the file that you should compile to
`./THEMENAME/css/styles.css` (note the same file name, using a different
extension of course).

#### See also:
- @link theme_settings Theme Settings @endlink
- @link templates Templates @endlink
- @link plugins Plugin System @endlink

[Bootstrap Framework]: https://getbootstrap.com/docs/3.3/
[Bootstrap Framework Source Files]: https://github.com/twbs/bootstrap/releases
[Less]: http://lesscss.org
