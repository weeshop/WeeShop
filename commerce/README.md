# Commerce 2.x project template

Use [Composer](https://getcomposer.org/) to get Drupal + Commerce 2.x with all dependencies.

Based on [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project).

## Usage

First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

> Note: The instructions below refer to the [global composer installation](https://getcomposer.org/doc/00-intro.md#globally).
You might need to replace `composer` with `php composer.phar` (or similar)
for your setup.

After that you can create the project:

```
composer create-project drupalcommerce/project-base some-dir --stability dev --no-interaction
```

Done! Use `composer require ...` to download additional modules and themes:

```
cd some-dir
composer require "drupal/devel:1.x-dev"
```

The `composer create-project` command passes ownership of all files to the
project that is created. You should create a new git repository, and commit
all files not excluded by the .gitignore file.

## What does the template do?

* Drupal is installed in the `web` directory.
* Modules (packages of type `drupal-module`) are placed in `web/modules/contrib/`
* Theme (packages of type `drupal-theme`) are placed in `web/themes/contrib/`
* Profiles (packages of type `drupal-profile`) are placed in `web/profiles/contrib/`
* Creates default writable versions of `settings.php` and `services.yml`.
* Creates the `web/sites/default/files` directory.
* Latest version of DrupalConsole is installed locally for use at `bin/drupal`.

## Updating Drupal Core

This project will attempt to keep all of your Drupal Core files up-to-date; the
project [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold)
is used to ensure that your scaffold files are updated every time drupal/core is
updated. If you customize any of the "scaffolding" files (commonly .htaccess),
you may need to merge conflicts if any of your modified files are updated in a
new release of Drupal core.

Follow the steps below to update your core files.

1. Run `composer update drupal/core webflo/drupal-core-require-dev symfony/* --with-dependencies` to update Drupal Core and its dependencies.
1. Run `git diff` to determine if any of the scaffolding files have changed.
   Review the files for any changes and restore any customizations to
  `.htaccess` or `robots.txt`.
1. Commit everything all together in a single commit, so `web` will remain in
   sync with the `core` when checking out branches or running `git bisect`.
1. In the event that there are non-trivial conflicts in step 2, you may wish
   to perform these steps on a branch, and use `git merge` to combine the
   updated core files with your customized files. This facilitates the use
   of a [three-way merge tool such as kdiff3](http://www.gitshah.com/2010/12/how-to-setup-kdiff-as-diff-tool-for-git.html). This setup is not necessary if your changes are simple;
   keeping all of your modifications at the beginning or end of the file is a
   good strategy to keep merges easy.

## Generate composer.json from existing project

With using [the "Composer Generate" drush extension](https://www.drupal.org/project/composer_generate)
you can now generate a basic `composer.json` file from an existing project. Note
that the generated `composer.json` might differ from this project's file.

## FAQ

### Should I commit the contrib modules I download?

Composer recommends **no**. They provide [argumentation against but also
workrounds if a project decides to do it anyway](https://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md).

### Should I commit the scaffolding files?

The [drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold) plugin can download the scaffold files (like
index.php, update.php, …) to the web/ directory of your project. If you have not customized those files you could choose
to not check them into your version control system (e.g. git). If that is the case for your project it might be
convenient to automatically run the drupal-scaffold plugin after every install or update of your project. You can
achieve that by registering `@composer drupal:scaffold` as post-install and post-update command in your composer.json:

```json
"scripts": {
    "drupal-scaffold": "DrupalComposer\\DrupalScaffold\\Plugin::scaffold",
    "post-install-cmd": [
        "@composer drupal:scaffold",
        "..."
    ],
    "post-update-cmd": [
        "@composer drupal:scaffold",
        "..."
    ]
},
```
### How can I apply patches to downloaded modules?

If you need to apply patches (depending on the project being modified, a pull
request is often a better solution), you can do so with the
[composer-patches](https://github.com/cweagans/composer-patches) plugin.

To add a patch to drupal module foobar insert the patches section in the extra
section of composer.json:
```json
"extra": {
    "patches": {
        "drupal/foobar": {
            "Patch description": "URL to patch"
        }
    }
}
```

### How can I add js/css libraries using composer.json?

It is possible to use frontend libraries with composer thanks to the
asset-packagist repository (https://asset-packagist.org/).

For example, to use colorbox:
```
composer require npm-asset/colorbox:"^0.4"

```
Composer will detect new versions of the library that meet your constraints.
In the above example it will download anything from 0.4.* series of colorbox.

When managing libraries with composer this way, you may not want to add it to
version control. In that case, add specific directories to the .gitignore file.
```
# Specific libraries (which we manage with composer)
web/libraries/colorbox
```

For more details, see https://asset-packagist.org/site/about

### How do I specify a PHP version ?

Currently Drupal 8 supports PHP 5.5.9 as minimum version (see [Drupal 8 PHP requirements](https://www.drupal.org/docs/8/system-requirements/drupal-8-php-requirements)), however it's possible that a `composer update` will upgrade some package that will then require PHP 7+.

To prevent this you can add this code to specify the PHP version you want to use in the `config` section of `composer.json`:
```json
"config": {
    "sort-packages": true,
    "platform": {"php": "5.5.9"}
},
```
