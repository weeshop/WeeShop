<!-- @file Documentation for the @BootstrapForm annotated discovery plugin. -->
<!-- @defgroup -->
<!-- @ingroup -->
# @BootstrapForm

- [Create a plugin](#create)
- [Rebuild the cache](#rebuild)

---

## Create a plugin {#create}

We'll use `SearchBlockForm` implemented by this base theme as an example of
how to remove `#input_group_button` from `search_block_form`.

Replace all following instances of `THEMENAME` with the actual machine name of
your sub-theme.

Create a file at `./THEMENAME/src/Plugin/Form/SearchBlockForm.php` with the
following contents:

```php
<?php

namespace Drupal\THEMENAME\Plugin\Form;

use Drupal\bootstrap\Plugin\Form\SearchBlockForm as BootstrapSearchBlockForm;
use Drupal\bootstrap\Utility\Element;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @ingroup plugins_form
 *
 * @BootstrapForm("search_block_form")
 */
class SearchBlockForm extends BootstrapSearchBlockForm {

  /**
   * {@inheritdoc}
   */
  public function alterForm(array &$form, FormStateInterface $form_state, $form_id = NULL) {
    // Call the parent method from the base theme, if applicable (which it is
    // in this case because Bootstrap actually implements this alter).
    parent::alterForm($form, $form_state, $form_id);

    // Disable #input_group_button the normal way:
    $form['keys']['#input_group_button'] = FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function alterFormElement(Element $form, FormStateInterface $form_state, $form_id = NULL) {
    // This method is the same as above, except the the $form argument passed is
    // an instance of \Drupal\bootstrap\Utility\Element for easier manipulation.
    // Using this method is preferable and considered "Best Practice".
    //
    // Disable #input_group_button using the $form Element object:
    // $form->keys->setProperty('input_group_button', FALSE);.
  }

  /**
   * {@inheritdoc}
   */
  public static function submitForm(array &$form, FormStateInterface $form_state) {
    // This method is automatically called when the form is submitted.
  }

  /**
   * {@inheritdoc}
   */
  public static function submitFormElement(Element $form, FormStateInterface $form_state) {
    // This method is the same as above, except the the $form argument passed is
    // an instance of \Drupal\bootstrap\Utility\Element for easier manipulation.
    // Using this method is preferable and considered "Best Practice".
  }

  /**
   * {@inheritdoc}
   */
  public static function validateForm(array &$form, FormStateInterface $form_state) {
    // This method is automatically called when the form is validated.
  }

  /**
   * {@inheritdoc}
   */
  public static function validateFormElement(Element $form, FormStateInterface $form_state) {
    // This method is the same as above, except the the $form argument passed is
    // an instance of \Drupal\bootstrap\Utility\Element for easier manipulation.
    // Using this method is preferable and considered "Best Practice".
  }

}
?>
```

## Rebuild the cache {#rebuild}

Once you have saved, you must rebuild your cache for this new plugin to be
discovered. This must happen anytime you make a change to the actual file name
or the information inside the `@BootstrapForm` annotation.

To rebuild your cache, navigate to `admin/config/development/performance` and
click the `Clear all caches` button. Or if you prefer, run `drush cr` from the
command line.

Voilà! After this, you should have a fully functional `@BootstrapForm` plugin!
