<?php
/**
 * @file
 * Contains \Drupal\dropdown\Form
 */

 namespace Drupal\dropdown\Form;

 use Drupal\Core\Database\Database;
 use Drupal\Core\Form\Formbase;
 use Drupal\Core\Form\FormStateInterface;

 /**
  * Provides node generator form.
  */
  class dropdownform extends FormBase {
      /**
       * (@inheritdoc)
       */
      public function getFormID(){
          return 'dropdown_api_form';
      }
/**
 * (@inheritdoc)
 */
public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getPArameter('node');
    $nid = $node->nid->value;
    $nform = array(
        '0' => 'Select Content',
        'Article' => 'Article',
        'Page' => 'Page',
    );
    $form['contents'] = array(
        '#title' => t('Select Content Type'),
        '#type' => 'select',
        '#options' => $nform
    );
    $form['Titl'] = array(
        '#title' => t('Title'),
        '#type' => 'textfield',
        '#size' => 16,
        '#description' => t("Enter the title."),
        '#required' => TRUE,
    );
    $form['Textareas'] = array(
        '#title' => t('Description'),
        '#type' => 'textarea',
        '#size' => 16,
        '#description' => t("Enter Description."),
        '#required' => TRUE,
    );
    
    $form['nodes'] = array(
        '#title' => t('Enter no of Node'),
        '#type' => 'textfield',
        '#size' => 16,
        '#description' => t("Input the no of node between 2 to 10."),
        '#required' => TRUE,
    );
    

    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('Submit'),
    );
    $form['nid'] = array(
        '#type' => 'hidden',
        '#value' => $nid,
    );
    return $form;

}
/**
 * (@inheritdoc)
 */
public function validateForm(array &$form, FormStateInterface $form_state){
  $value = $form_state->getValue('nodes');
  if($value >5){
    $form_state->setErrorByName ('api', t('Node should not be greater than 5 .', array('%mail'=>$value)));
  }
}

/**
 * (@inheritdoc)
 */
  public function submitForm(array &$form, FormStateInterface $form_state){
     /* drupal_set_message(t('the from is working'));*/
     $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
     db_insert('dropdown')
       ->fields(array(
           'content' => $form_state->getValue('contents'),
           'Titles' => $form_state->getValue('Titl'),
           'Descriptions' => $form_state->getValue('Textareas'),
           'node' => $form_state->getValue('nodes'),
           'nid' => $form_state->getValue('nid'),
           'uid' => $user->id(),
           'created' => time(),
       ))
       ->execute();
       drupal_set_message(t('Node is created Successfully.'));

  }

  }