<?php
/**
 * @file
 * Contains \Drupal\rsvplist\Form
 */

 namespace Drupal\rsvplist\Form;

 use Drupal\Core\Database\Database;
 use Drupal\Core\Form\Formbase;
 use Drupal\Core\Form\FormStateInterface;

 /**
  * Provides an RSVP Email Form.
  */
  class RSVPForm extends FormBase {
      /**
       * (@inheritdoc)
       */
      public function getFormID(){
          return 'rsvplist_email_form';
      }
/**
 * (@inheritdoc)
 */
public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getPArameter('node');
    $nid = $node->nid->value;
    $form['email'] = array(
        '#title' => t('Email Address'),
        '#type' => 'textfield',
        '#size' => 25,
        '#description' => t("we'll send updates to the email address you provide."),
        '#required' => TRUE,
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('RSVP'),
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
  $value = $form_state->getValue('email');
  if($value == !\Drupal::service('email.validator')->isValid($value)){
    $form_state->setErrorByName ('email', t('The email address mail is not valid.', array('%mail'=>$value)));
  }
}

/**
 * (@inheritdoc)
 */
  public function submitForm(array &$form, FormStateInterface $form_state){
     /* drupal_set_message(t('the from is working'));*/
     $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
     db_insert('rsvplist')
       ->fields(array(
           'mail' => $form_state->getValue('email'),
           'nid' => $form_state->getValue('nid'),
           'uid' => $user->id(),
           'created' => time(),
       ))
       ->execute();
       drupal_set_message(t('Thank fro your RSVP, YOu are on the list for the event.'));

  }

  }