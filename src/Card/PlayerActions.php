<?php

namespace App\Card;

/**
 * Interface PlayerActions
 * @package mykisscool\Blackjack
 * @author Mike Petruniak <mike.petruniak@gmail.com>
 */
interface PlayerActions
{

   /**
    * Player takes a card from the top of the deck
    * @param Card $cardForTesting Allow this method to accept an instance of class Card for testing purposes
    * @access public
    * @return void
    */
   public function hit(Card $cardForTesting);

   /**
    * The player no longer wishes to hit- and is ending his/her hand.  A winner is determined at this
    * point.
    * @access public
    * @return void
    */
   public function stand();
}
