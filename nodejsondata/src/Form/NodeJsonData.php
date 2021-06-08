<?php

namespace Drupal\nodejsondata\Form;
use Drupal\Core\Form\ConfigFormBase;
//use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class NodeJsonData extends ConfigFormBase {

    /**
    * {@inheritdoc}
    */
    protected function getEditableConfigNames() {
        return [
            'nodejsondata.externalapikey',
        ];
    }



    /**
     * {@inheritdoc}
     */

    public function getFormId() {
        return 'your_external_api_key';

    }

    /**
     * {@inheritdoc}
     */
    
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('nodejsondata.externalapikey');
        $form['your_external_api_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Enter Api Key :'),
            '#description' => $this->t('Store Api Key'),
            '#maxlength' => 16,
            '#size' => 16,
            '#default_value' => $config->get('your_external_api_key'),
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Save'),
        ];
        return $form;

    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('nodejsondata.externalapikey')->set('your_external_api_key', $form_state->getValue('your_external_api_key'))->save();
        drupal_set_message("success");
    }
}