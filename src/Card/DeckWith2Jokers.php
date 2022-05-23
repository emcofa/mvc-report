<?php

namespace App\Card;

/**
 * Class DeckWith2Jokers
 * @package App\Card;
 * @author Emmie Fahlström
 */
class DeckWith2Jokers extends Deck
{
    /**
     * Constructor for creating a deck with jokers
     */
    public function __construct()
    {
        parent::__construct();
        $card1 = new Card("11", "J");
        $card2 = new Card("12", "J");
        array_push($this->allCards, $card1);
        array_push($this->allCards, $card2);
    }
}
