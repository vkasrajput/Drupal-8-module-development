<?php
/**
 * @file
 * Contains \Drupal\nodegenerator\Form
 */

 namespace Drupal\nodegenerator\Form;

 use Drupal\Core\Database\Database;
 use Drupal\Core\Form\Formbase;
 use Drupal\Core\Form\FormStateInterface;

 /**
  * Provides node generator form.
  */
  class NodegeneratorForm extends FormBase {
      /**
       * (@inheritdoc)
       */
      public function getFormID(){
          return 'nodegenerator_api_form';
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
  if(($value <2) or ($value>10)){
    $form_state->setErrorByName ('api', t('Please Enter the Noderfrr from 2 to 10.', array('%mail'=>$value)));
  }
}

/**
 * (@inheritdoc)
 */
  public function submitForm(array &$form, FormStateInterface $form_state){
     /* drupal_set_message(t('the from is working'));*/
     $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
     db_insert('nodegenerator')
       ->fields(array(
           'content' => $form_state->getValue('contents'),
           'node' => $form_state->getValue('nodes'),
           'nid' => $form_state->getValue('nid'),
           'uid' => $user->id(),
           'created' => time(),
       ))
       ->execute();
       drupal_set_message(t('Node is created Successfully.'));

  }

  }