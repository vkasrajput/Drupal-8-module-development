<?php

namespace Drupal\nodejsondata\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\jsonResponse;

/**
 * Class ApiController.
 */
class ApiController extends ControllerBase {

      /**
     * Showkey.
     *
     * @return array
     *
     */
    public function ShowKey($apikey,$nodeid) {

        $values = \Drupal::entityQuery('node')->condition('nid', $nodeid)->execute();
        $nodeid = !empty($values);
        $externalapikey = \Drupal::config('nodejsondata.externalapikey')->get('your_external_api_key');
        if ($apikey == $externalapikey && $nodeid) {
            return new jsonResponse(
                [
                    '#type' => 'markup',
                    '#markup' => $this->t('The configuration Api Key is:  '. $externalapikey),
                    'data' => $this->result(),
                    'method' => 'GET',
              ]
              );
        }
        else {
            return (
                [
                    '#type' => 'markup',
                    '#markup' => $this->t('INVALID API KEY :'.$nodeid),
                ]
            );
        }
  
    }

    private function result() {
        return [
                ["id" => 1, "name" => "Vikas Singh", "Contact" => 8787002307],
                ["id" => 2, "name" => "Tarun Chauhan", "Contact" => 8787002306],
                ["id" => 3, "name" => "Vansh Sharma", "Contact" => 954326543],
                ["id" => 4, "name" => "Rishabh Panwar", "Contact" => 88775643],
            ];
    }
        
}


