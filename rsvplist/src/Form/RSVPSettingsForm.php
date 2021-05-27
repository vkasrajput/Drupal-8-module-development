<?php
/**
 * @file
 * conatins \Drupal\rsvplist\Form\RSVPSettingsForm
 */

 namespace Drupal\rsvplist\Form;

 use Drupal\Core\Form\ConfigFormBase;
 use Symfony\Component\HttpFoundation\Request;
 use Drupal\Core\Form\FormStateInterface;

 /**
  * defines a form to configure RSSVP  List module setting
  */

class RSVPSettingsForm extends ConfigFormBase {
    /**
     * {@interitdoc}
     */
    public function getFormID(){
        return 'rsvplist_admin_settings';
    }
    /**
     * {@Iherritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'rsvplist.settings'
        ];
    }

}