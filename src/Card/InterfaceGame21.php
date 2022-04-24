<?php

namespace App\Card;

//Interface of game 21
interface InterfaceGame21
{
    /**
     * Resets current player scores and draw new cards
     * @access public
     * @return void
     */
    public function new();

    /**
     * Dealers turn to draw card after player is finished
     * @access public
     * @return void
     */
    public function dealersTurn();

    /**
     * Returns the deck
     * @access public
     * @return Deck
     */
    public function returnDeck();


    /**
     * Returns the dealer
     * @return Player21
     */
    public function returnDealer();

    /**
     * Returns the player
     * @return Player21
     */
    public function returnPlayer();

    /**
     * Checks who is the winner of the game and returns status
     * @access public
     * @return string
     */
    public function checkStatus();
}
