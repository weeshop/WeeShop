<!-- @file Documentation landing page and topics for the https://drupal-bootstrap.org site. -->
<!-- @mainpage -->
# Drupal Bootstrap Documentation

{.lead} The official documentation site for the [Drupal Bootstrap] base theme

The majority of this site is automatically generated from source files
located through out the project's repository. Topics are extracted from Markdown
files and the rest is extracted from embedded PHP comments.

---

## Topics

Below are some topics to help get you started using the [Drupal Bootstrap] base
theme. They are ordered based on the level one typically progresses while using
a base theme like this.

#### @link contributing Contributing @endlink

#### @link getting_started Getting Started @endlink

#### @link theme_settings Theme Settings @endlink

#### @link sub_theming Sub-Theming @endlink
- @link sub_theming_cdn CDN Starterkit @endlink
- @link sub_theming_less Less Starterkit @endlink
- @link sub_theming_sass Sass Starterkit @endlink

#### @link templates Templates @endlink

#### @link utility Utilities @endlink

#### @link plugins Plugin System @endlink
- @link plugins_alter @BootstrapAlter @endlink
- @link plugins_form @BootstrapForm @endlink
- @link plugins_preprocess @BootstrapPreprocess @endlink
- @link plugins_prerender @BootstrapPrerender @endlink
- @link plugins_process @BootstrapProcess @endlink
- @link plugins_provider @BootstrapProvider @endlink
- @link plugins_setting @BootstrapSetting @endlink
- @link plugins_update @BootstrapUpdate @endlink

#### @link maintainers Project Maintainers @endlink

---

## Terminology

The term **"bootstrap"** can be used excessively through out this project's
documentation. For clarity, we will always attempt to use this word verbosely
in one of the following ways:

- **[Drupal Bootstrap]** refers to the Drupal base theme project.
- **[Bootstrap Framework](https://getbootstrap.com/docs/3.3/)** refers to the external
  front end framework.
- **[drupal_bootstrap](https://api.drupal.org/apis/drupal_bootstrap)** refers
  to Drupal's bootstrapping process or phase.
  
When referring to files inside the [Drupal Bootstrap] project directory, they
will always start with `./bootstrap` and continue to specify the full path to
the file or directory inside it. For example, the file that is responsible for
displaying the text on this page is located at `./bootstrap/docs/README.md`.

When referring to files inside a sub-theme, they will always start with
`./THEMENAME/`, where `THEMENAME` is the machine name of your sub-theme. They
will continue to specify the full path to the file or directory inside it. For
example, the primary file Drupal uses to determine if a theme
exists is: `./THEMENAME/THEMENAME.info.yml`.

[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap
