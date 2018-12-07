<!-- @file Overview of theme settings for Drupal Bootstrap based themes. -->
<!-- @defgroup -->
<!-- @ingroup -->
# Theme Settings

To override a setting, open `./config/install/THEMENAME.settings.yml`
and add the following:

```yaml
# Settings

settings:
  SETTING_NAME: SETTING_VALUE
```

---

### Advanced

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
include_deprecated
    </td>
    <td>
      <div class="help-block">
Enabling this setting will include any <code>deprecated.php</code> file
found in your theme or base themes.
      </div>
      <pre class=" language-yaml"><code>
include_deprecated: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
suppress_deprecated_warnings
    </td>
    <td>
      <div class="help-block">
Enable this setting if you wish to suppress deprecated warning messages.
<strong class='error text-error'>WARNING: Suppressing these messages does
not "fix" the problem and you will inevitably encounter issues
when they are removed in future updates. Only use this setting in extreme
and necessary circumstances.</strong>
      </div>
      <pre class=" language-yaml"><code>
suppress_deprecated_warnings: 0

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### Advanced > CDN (Content Delivery Network)

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
cdn_provider
    </td>
    <td>
      <div class="help-block">
Choose between jsdelivr or a custom cdn source.
      </div>
      <pre class=" language-yaml"><code>
cdn_provider: jsdelivr

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_custom_css
    </td>
    <td>
      <div class="help-block">
It is best to use <code>https</code> protocols here as it will allow more
flexibility if the need ever arises.
      </div>
      <pre class=" language-yaml"><code>
cdn_custom_css:
'https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.css'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_custom_css_min
    </td>
    <td>
      <div class="help-block">
Additionally, you can provide the minimized version of the file. It will be
used instead if site aggregation is enabled.
      </div>
      <pre class=" language-yaml"><code>
cdn_custom_css_min:
'https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_custom_js
    </td>
    <td>
      <div class="help-block">
It is best to use <code>https</code> protocols here as it will allow more
flexibility if the need ever arises.
      </div>
      <pre class=" language-yaml"><code>
cdn_custom_js: 'https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.js'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_custom_js_min
    </td>
    <td>
      <div class="help-block">
Additionally, you can provide the minimized version of the file. It will be
used instead if site aggregation is enabled.
      </div>
      <pre class=" language-yaml"><code>
cdn_custom_js_min:
'https://cdn.jsdelivr.net/bootstrap/3.3.7/js/bootstrap.min.js'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_jsdelivr_version
    </td>
    <td>
      <div class="help-block">
Choose the Bootstrap version from jsdelivr
      </div>
      <pre class=" language-yaml"><code>
cdn_jsdelivr_version: 3.3.7

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
cdn_jsdelivr_theme
    </td>
    <td>
      <div class="help-block">
Choose the example Bootstrap Theme provided by Bootstrap or one of the
Bootswatch themes.
      </div>
      <pre class=" language-yaml"><code>
cdn_jsdelivr_theme: bootstrap

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### Components > Breadcrumbs

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
breadcrumb
    </td>
    <td>
      <div class="help-block">
Show or hide the Breadcrumbs
      </div>
      <pre class=" language-yaml"><code>
breadcrumb: '1'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
breadcrumb_home
    </td>
    <td>
      <div class="help-block">
If your site has a module dedicated to handling breadcrumbs already, ensure
this setting is enabled.
      </div>
      <pre class=" language-yaml"><code>
breadcrumb_home: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
breadcrumb_title
    </td>
    <td>
      <div class="help-block">
If your site has a module dedicated to handling breadcrumbs already, ensure
this setting is disabled.
      </div>
      <pre class=" language-yaml"><code>
breadcrumb_title: 1

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### Components > Navbar

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
navbar_inverse
    </td>
    <td>
      <div class="help-block">
Select if you want the inverse navbar style.
      </div>
      <pre class=" language-yaml"><code>
navbar_inverse: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
navbar_position
    </td>
    <td>
      <div class="help-block">
Determines where the navbar is positioned on the page.
      </div>
      <pre class=" language-yaml"><code>
navbar_position: ''

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### Components > Region Wells

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
region_wells
    </td>
    <td>
      <div class="help-block">
Enable the <code>.well</code>, <code>.well-sm</code> or
<code>.well-lg</code> classes for specified regions.
      </div>
      <pre class=" language-yaml"><code>
region_wells:
  navigation: ''
  navigation_collapsible: ''
  header: ''
  highlighted: ''
  help: ''
  content: ''
  sidebar_first: ''
  sidebar_second: well
  footer: ''

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### General > Buttons

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
button_colorize
    </td>
    <td>
      <div class="help-block">
Adds classes to buttons based on their text value.
      </div>
      <pre class=" language-yaml"><code>
button_colorize: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
button_iconize
    </td>
    <td>
      <div class="help-block">
Adds icons to buttons based on the text value
      </div>
      <pre class=" language-yaml"><code>
button_iconize: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
button_size
    </td>
    <td>
      <div class="help-block">
Defines the Bootstrap Buttons specific size
      </div>
      <pre class=" language-yaml"><code>
button_size: ''

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### General > Container

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
fluid_container
    </td>
    <td>
      <div class="help-block">
Uses the <code>.container-fluid</code> class instead of
<code>.container</code>.
      </div>
      <pre class=" language-yaml"><code>
fluid_container: 0

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### General > Forms

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
forms_has_error_value_toggle
    </td>
    <td>
      <div class="help-block">
If an element has a <code>.has-error</code> class attached to it, enabling
this will automatically remove that class when a value is entered.
      </div>
      <pre class=" language-yaml"><code>
forms_has_error_value_toggle: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
forms_required_has_error
    </td>
    <td>
      <div class="help-block">
If an element in a form is required, enabling this will always display the
element with a <code>.has-error</code> class. This turns the element red
and helps in usability for determining which form elements are required to
submit the form.
      </div>
      <pre class=" language-yaml"><code>
forms_required_has_error: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
forms_smart_descriptions
    </td>
    <td>
      <div class="help-block">
Convert descriptions into tooltips (must be enabled) automatically based on
certain criteria. This helps reduce the, sometimes unnecessary, amount of
noise on a page full of form elements.
      </div>
      <pre class=" language-yaml"><code>
forms_smart_descriptions: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
forms_smart_descriptions_allowed_tags
    </td>
    <td>
      <div class="help-block">
Prevents descriptions from becoming tooltips by checking for HTML not in
the list above (i.e. links). Separate by commas. To disable this filtering
criteria, leave an empty value.
      </div>
      <pre class=" language-yaml"><code>
forms_smart_descriptions_allowed_tags: 'b, code, em, i, kbd, span, strong'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
forms_smart_descriptions_limit
    </td>
    <td>
      <div class="help-block">
Prevents descriptions from becoming tooltips by checking the character
length of the description (HTML is not counted towards this limit). To
disable this filtering criteria, leave an empty value.
      </div>
      <pre class=" language-yaml"><code>
forms_smart_descriptions_limit: '250'

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### General > Images

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
image_responsive
    </td>
    <td>
      <div class="help-block">
Images in Bootstrap 3 can be made responsive-friendly via the addition of
the <code>.img-responsive</code> class. This applies <code>max-width:
100%;</code> and <code>height: auto;</code> to the image so that it scales
nicely to the parent element.
      </div>
      <pre class=" language-yaml"><code>
image_responsive: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
image_shape
    </td>
    <td>
      <div class="help-block">
Add classes to an <code>&lt;img&gt;</code> element to easily style images
in any project.
      </div>
      <pre class=" language-yaml"><code>
image_shape: ''

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### General > Tables

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
table_bordered
    </td>
    <td>
      <div class="help-block">
Add borders on all sides of the table and cells.
      </div>
      <pre class=" language-yaml"><code>
table_bordered: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
table_condensed
    </td>
    <td>
      <div class="help-block">
Make tables more compact by cutting cell padding in half.
      </div>
      <pre class=" language-yaml"><code>
table_condensed: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
table_hover
    </td>
    <td>
      <div class="help-block">
Enable a hover state on table rows.
      </div>
      <pre class=" language-yaml"><code>
table_hover: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
table_striped
    </td>
    <td>
      <div class="help-block">
Add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.
      </div>
      <pre class=" language-yaml"><code>
table_striped: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
table_responsive
    </td>
    <td>
      <div class="help-block">
Wraps tables with <code>.table-responsive</code> to make them horizontally
scroll when viewing them on devices under 768px. When viewing on devices
larger than 768px, you will not see a difference in the presentational
aspect of these tables. The <code>Automatic</code> option will only apply
this setting for front-end facing tables, not the tables in administrative
areas.
      </div>
      <pre class=" language-yaml"><code>
table_responsive: -1

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### JavaScript > Modals

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
modal_enabled
    </td>
    <td>
      <div class="help-block">
Enabling this will replace core's jQuery UI Dialog implementations with
modals from the Bootstrap Framework.
      </div>
      <pre class=" language-yaml"><code>
modal_enabled: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
modal_animation
    </td>
    <td>
      <div class="help-block">
Apply a CSS fade transition to modals.
      </div>
      <pre class=" language-yaml"><code>
modal_animation: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
modal_backdrop
    </td>
    <td>
      <div class="help-block">
Includes a modal-backdrop element. Alternatively, specify
<code>static</code> for a backdrop which doesn't close the modal on click.
      </div>
      <pre class=" language-yaml"><code>
modal_backdrop: 'true'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
modal_keyboard
    </td>
    <td>
      <div class="help-block">
Closes the modal when escape key is pressed.
      </div>
      <pre class=" language-yaml"><code>
modal_keyboard: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
modal_show
    </td>
    <td>
      <div class="help-block">
Shows the modal when initialized.
      </div>
      <pre class=" language-yaml"><code>
modal_show: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
modal_size
    </td>
    <td>
      <div class="help-block">
Defines the modal size between the default, <code>modal-sm</code> and
<code>modal-lg</code>.
      </div>
      <pre class=" language-yaml"><code>
modal_size: ''

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### JavaScript > Popovers

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
popover_enabled
    </td>
    <td>
      <div class="help-block">
Elements that have the <code>data-toggle=&quot;popover&quot;</code>
attribute set will automatically initialize the popover upon page load.
<strong class='error text-error'>WARNING: This feature can sometimes impact
performance. Disable if pages appear to hang after initial load.</strong>
      </div>
      <pre class=" language-yaml"><code>
popover_enabled: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_animation
    </td>
    <td>
      <div class="help-block">
Apply a CSS fade transition to the popover.
      </div>
      <pre class=" language-yaml"><code>
popover_animation: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_container
    </td>
    <td>
      <div class="help-block">
Appends the popover to a specific element. Example: <code>body</code>. This
option is particularly useful in that it allows you to position the popover
in the flow of the document near the triggering element - which will
prevent the popover from floating away from the triggering element during a
window resize.
      </div>
      <pre class=" language-yaml"><code>
popover_container: body

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_content
    </td>
    <td>
      <div class="help-block">
Default content value if <code>data-content</code> or
<code>data-target</code> attributes are not present.
      </div>
      <pre class=" language-yaml"><code>
popover_content: ''

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_delay
    </td>
    <td>
      <div class="help-block">
The amount of time to delay showing and hiding the popover (in
milliseconds). Does not apply to manual trigger type.
      </div>
      <pre class=" language-yaml"><code>
popover_delay: '0'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_html
    </td>
    <td>
      <div class="help-block">
Insert HTML into the popover. If false, jQuery's text method will be used
to insert content into the DOM. Use text if you're worried about XSS
attacks.
      </div>
      <pre class=" language-yaml"><code>
popover_html: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_placement
    </td>
    <td>
      <div class="help-block">
Where to position the popover. When <code>auto</code> is specified, it will
dynamically reorient the popover. For example, if placement is <code>auto
left</code>, the popover will display to the left when possible, otherwise
it will display right.
      </div>
      <pre class=" language-yaml"><code>
popover_placement: right

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_selector
    </td>
    <td>
      <div class="help-block">
If a selector is provided, tooltip objects will be delegated to the
specified targets. In practice, this is used to enable dynamic HTML content
to have popovers added.
      </div>
      <pre class=" language-yaml"><code>
popover_selector: ''

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_title
    </td>
    <td>
      <div class="help-block">
Default title value if <code>title</code> attribute isn't present.
      </div>
      <pre class=" language-yaml"><code>
popover_title: ''

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_trigger
    </td>
    <td>
      <div class="help-block">
How a popover is triggered.
      </div>
      <pre class=" language-yaml"><code>
popover_trigger: click

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
popover_trigger_autoclose
    </td>
    <td>
      <div class="help-block">
Will automatically close the current popover if a click occurs anywhere
else other than the popover element.
      </div>
      <pre class=" language-yaml"><code>
popover_trigger_autoclose: 1

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

---

### JavaScript > Tooltips

<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th class="col-xs-3">Setting name</th>
      <th>Description and default value</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    <td class="col-xs-3">
tooltip_enabled
    </td>
    <td>
      <div class="help-block">
Elements that have the <code>data-toggle="tooltip"</code>
attribute set will automatically initialize the tooltip upon page load.
<strong class='error text-error'>WARNING: This feature can sometimes impact
performance. Disable if pages appear to "hang" after initial
load.</strong>
      </div>
      <pre class=" language-yaml"><code>
tooltip_enabled: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_animation
    </td>
    <td>
      <div class="help-block">
Apply a CSS fade transition to the tooltip.
      </div>
      <pre class=" language-yaml"><code>
tooltip_animation: 1

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_container
    </td>
    <td>
      <div class="help-block">
Appends the tooltip to a specific element. Example: <code>body</code>.
      </div>
      <pre class=" language-yaml"><code>
tooltip_container: body

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_delay
    </td>
    <td>
      <div class="help-block">
The amount of time to delay showing and hiding the tooltip (in
milliseconds). Does not apply to manual trigger type.
      </div>
      <pre class=" language-yaml"><code>
tooltip_delay: '0'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_html
    </td>
    <td>
      <div class="help-block">
Insert HTML into the tooltip. If false, jQuery's text method will be used
to insert content into the DOM. Use text if you're worried about XSS
attacks.
      </div>
      <pre class=" language-yaml"><code>
tooltip_html: 0

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_placement
    </td>
    <td>
      <div class="help-block">
Where to position the tooltip. When <code>auto</code> is specified, it will
dynamically reorient the tooltip. For example, if placement is <code>auto
left</code>, the tooltip will display to the left when possible, otherwise
it will display right.
      </div>
      <pre class=" language-yaml"><code>
tooltip_placement: 'auto left'

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_selector
    </td>
    <td>
      <div class="help-block">
If a selector is provided, tooltip objects will be delegated to the
specified targets.
      </div>
      <pre class=" language-yaml"><code>
tooltip_selector: ''

</code></pre>
    </td>
  </tr>
  <tr>
    <td class="col-xs-3">
tooltip_trigger
    </td>
    <td>
      <div class="help-block">
How a tooltip is triggered.
      </div>
      <pre class=" language-yaml"><code>
tooltip_trigger: hover

</code></pre>
    </td>
  </tr>
  </tbody>
</table>

[Drupal Bootstrap]: https://www.drupal.org/project/bootstrap
[Bootstrap Framework]: https://getbootstrap.com/docs/3.3/
