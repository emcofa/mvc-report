<?php

namespace App\Card;

//Interface for players
interface InterfacePlayer21
{
    /**
     * Player takes a card from the top of the deck
     * @param Card $defaultCard
     * @access public
     * @return void
     */
    public function hit(Card $defaultCard);

    /**
     * The player is satisfied. Winner pronounces.
     * @access public
     * @return void
     */
    public function stand();

    /**
     * Resets current hand and current score
     * @access public
     * @return void
     */
    public function clearCurrentHand();

    /**
     * Returns current hand
     * @param $activeHand
     * @access public
     * @return string
     */
    public function getCurrentHand($activeHand = true);

    /**
     * Returns current score of hand
     * @param $activeHand
     * @access public
     * @return int
     */
    public function getCurrentScore($activeHand = true);

    /**
     * Dealers turn to draw cards (lowest value of dealer = 17)
     * @access public
     * @return void
     */
    public function dealersTurn();

    /**
     * Get player, default "player" else "dealer
     * @param $player
     * @access public
     * @return self
     */
    public static function getPlayer($player = 'player');
}
