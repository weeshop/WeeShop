<!-- @file The "Getting Started" topic. -->
<!-- @defgroup -->
# Getting Started

## Installation
- Install the Bootstrap base theme in `themes` or a similar `sites/*/themes`
  directory.
- Enable the [Drupal Bootstrap] base theme.

## Bootstrap Framework Fundamentals
Generally speaking, you should really read the entire [Bootstrap Framework]
documentation site, if you haven't already. Here are the four basic "sections"
that site is split into:

- [Getting Started](https://getbootstrap.com/docs/3.3/getting-started) - An overview of
  the [Bootstrap Framework], how to download and use, basic templates and
  examples, and more.
- [CSS](https://getbootstrap.com/docs/3.3/css/) - Global CSS settings, fundamental HTML
  elements styled and enhanced with extensible classes, and an advanced grid
  system.
- [Components](https://getbootstrap.com/docs/3.3/components/) - Over a dozen reusable
  components built to provide iconography, dropdowns, input groups, navigation,
  alerts, and much more.
- [JavaScript](https://getbootstrap.com/docs/3.3/javascript/) - Bring the
  [Bootstrap Framework] components to life with over a dozen custom jQuery
  plugins. Easily include them all, or one by one.


## FAQ - Frequently Asked Questions

- [Do you support X module?](#support)
- [Do you support Internet Explorer?](#ie)
- [Is Drupal Bootstrap a module or theme?](#module-or-theme)
- [Where can I discuss an issue in real time?](#irc)
- [Where should I make changes?](#changes)

---

### Q: Do you support X module? {#support}
**A: Possibly**

Below are a list of modules the [Drupal Bootstrap] base theme actively supports.
This list is constantly growing and each module's support has usually been
implemented because of either extremely high usage or the fact it was designed
explicitly for use with this base theme and has maintainers in both projects.

**Supported modules:**
See project page for a list of supported modules.

**"Un-supported" modules:**
The following modules are "un-supported modules" and are not documented by the
[Drupal Bootstrap] base theme. This does not mean that the base theme will not
work with them or that they are "bad". It simply means that this project does
not have the time, energy or effort it would take to document "every possible
scenario".

It is certainly possible that some of these modules may eventually become
"officially" supported. That will happen only, of course, if there are enough
people to help contribute solid solutions and make supporting them by the base
theme maintainers a relatively "easy" task.

Some of these modules may have blogs or videos floating around on the internet.
However, if you choose to use one of these modules, you are really doing so
at your own expense. Do not expect support from this base theme or the project
you are attempting to integrate the base theme with.

- Color module (in core)
- [Bootstrap API](https://www.drupal.org/project/bootstrap_api)
- [Bootstrap Library](https://www.drupal.org/project/bootstrap_library)
- [LESS module](https://www.drupal.org/project/less)

---

### Q: Do you support Internet Explorer? {#ie}
**A: No, not "officially"**

The [Bootstrap Framework] itself does not officially support older Internet
Explorer [compatibility modes](https://getbootstrap.com/docs/3.3/getting-started/#support-ie-compatibility-modes).
To ensure you are using the latest rendering mode for IE, consider installing
the [HTML5 Tools](https://www.drupal.org/project/html5_tools) module.

Internet Explorer 8 requires the use of [Respond.js] to enable media queries
(Responsive Web Design). However, [Respond.js] does not work with CSS that is
referenced via a CSS `@import` statement, which is the default way Drupal
adds CSS files to a page when CSS aggregation is disabled. To ensure
[Respond.js] works properly, enable CSS aggregation at the bottom of:
`admin/config/development/performance`.

---

### Q: Is Drupal Bootstrap a module or theme? {#module-or-theme}
**A: Theme**

More specifically a base theme. It is _not_ a module. Modules are allowed to
participate in certain hooks, while themes cannot. This is a very important
concept to understand and limits themes from participating in a wider range of
functionality.

---

### Q: Where can I discuss an issue in real time? {#irc}
**A: In IRC**

The [Drupal Bootstrap] project and its maintainers use the `#drupal-bootstrap`
channel on the freenode.net IRC network to communicate in real time. Please read
the following for more information on how to the community uses this technology:
[Chat with the Drupal Community on IRC](https://www.drupal.org/irc).

Please keep in mind though, this **IS NOT** a "support" channel. It's primary
use is to discuss issues and to help fix bugs with the base theme itself.

---

### Q: Where should I make changes? {#changes}
**A: In a custom sub-theme**

You should **never** modify any theme or sub-theme that is packaged and released
from Drupal.org. If you do, all changes you have made would be lost once that
theme is updated. This makes keeping track of changes next to impossible.

Instead, you should create a custom sub-theme that isn't hosted on Drupal.org.

[Respond.js]: https://github.com/scottjehl/Respond
[Drush]: http://www.drush.org
[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap
[Bootstrap Framework]: https://getbootstrap.com/docs/3.3/
[jQuery Update]: https://www.drupal.org/project/jquery_update
