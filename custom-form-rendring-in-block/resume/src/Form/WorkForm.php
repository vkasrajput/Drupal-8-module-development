<?php
/**
 * @file
 * Contains \Drupal\resume\Form\WorkForm.
 */
namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class workForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['employee_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
    );
    $opt = array(
      0 => '1',
      1 => '2',
      2 => '3',
      3 => '4',
      4 => '5',
      
    );

    $form['Feedback'] = array(
      '#type' => 'radios',
      '#title' => t('Feedback:'),
      '#options' => $opt
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
     db_insert('resume')
       ->fields(array(
           'Name' => $form_state->getValue('employee_name'),
           'Rating' => $form_state->getValue('Feedback'),
           'nid' => $form_state->getValue('nid'),
           'uid' => $user->id(),
           'created' => time(),
       ))
       ->execute();

    drupal_set_message($this->t('@emp_name ,Your application is being submitted!', array('@emp_name' => $form_state->getValue('employee_name'))));

  }
}