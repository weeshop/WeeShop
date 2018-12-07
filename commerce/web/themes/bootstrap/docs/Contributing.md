<!-- @file Overview on how to contribute to the Drupal Bootstrap project. -->
<!-- @defgroup -->
# Contributing

Please read the @link faq FAQ @endlink and
@link getting_started Getting Started @endlink topics first before creating
an issue in this project's issue queue.

Anything that falls within the scope of existing documentation or answered
questions will be marked as "Closed (works as designed)" or
"Closed (won't fix)".

The [Theme development](https://www.drupal.org/forum/3) support forum and
[Drupal StackExchange](https://drupal.stackexchange.com) are also amazing
resources for asking questions, learning new techniques and overall general
support.

## Drupal.org Handbook Pages
There has been some amazing Drupal Community work done around integration
between Drupal and the [Bootstrap Framework]. Additional community driven
documentation can be found on the [original Drupal.org handbook pages](https://www.drupal.org/node/1976938).

If you find that the documentation in these locations are inaccurate or
missing, please update it yourself (all logged in users have edit
capability).

## Creating New Issues

{.alert.alert-info} **Recommended reading:** [How To Solve All Your [Drupal] Problems](http://www.lullabot.com/blog/article/how-solve-all-your-problems)

{.alert.alert-warning} Please, [search the issue queue](https://www.drupal.org/project/issues/search/bootstrap)
first. **DO NOT** duplicate existing issues.

**If you find an existing issue and the issue status is:**
- Closed (fixed, duplicate, won't fix) - **DO NOT** re-open it. Open a new
  issue (unless it's "Closed (won't fix)") and reference the existing issue in
  the "Related Issues" field.
- Active, NR, NW, RTBC - Please update the issue accordingly, **DO NOT** create
  a new issue.

**The [Drupal Bootstrap] issue queue IS for:**
- Fixing bugs and adding new features pertaining to the integration between
  Drupal and the [Bootstrap Framework].

**The [Drupal Bootstrap] issue queue IS NOT for:**
- Bugs/feature requests pertaining to the [Bootstrap Framework] itself. Use
  [their issue queue](https://github.com/twbs/bootstrap/issues) instead.
- Custom CSS/Layout (e.g. site specific)
- LESS/SASS - Compilation errors, syntax, mixins/functions
- JavaScript, jQuery, Bootstrap plugins or custom (site specific) plugins
- Modules that don't work in multiple themes. File the issue with that module.
  It is likely they are not using [APIs](https://api.drupal.org) properly, not
  following existing [Coding Standards](https://www.drupal.org/coding-standards)
  or not developing with [Best Practices](https://www.drupal.org/best-practices) in
  mind. It is actually a rare event when it is a legitimate issue with the
  [Drupal Bootstrap] project.

## IRC
The [Drupal Bootstrap] project and its maintainers use the `#drupal-bootstrap`
channel on the freenode.net IRC network to communicate in real time. Please read
the following for more information on how to the community uses this technology:
[Chat with the Drupal Community on IRC](https://www.drupal.org/irc).

Please keep in mind though, this **IS NOT** a "support" channel. It's primary
use is to discuss issues and to help fix bugs with the base theme itself.

[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap
[Bootstrap Framework]: https://getbootstrap.com/docs/3.3/
