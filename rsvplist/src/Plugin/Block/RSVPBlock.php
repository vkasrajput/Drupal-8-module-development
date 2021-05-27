<?php
/**
 * @file
 * conataons \Drupal\rsvplist\Plugin\Block
 */
namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccontInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides an 'RSVP' List Block
 * @Block(
 * id = "rsvp_block",
 * admin_level = @Translation("RSVP Block"),
 * )
 */

 class RSVPBlock extends Blockbase {
     /**
      * {@inheritdoc}
      */
      public function build(){
          return array('#markup' => $this->t('My RSVP List Block'));
      }
 }