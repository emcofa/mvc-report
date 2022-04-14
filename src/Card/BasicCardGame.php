<?php

namespace App\Card;

class BasicCardGame
{
    // prints out a deck of cards
    public $numCards = 52;
    private $allCards;
    private $gameArray = [];

    public function __construct()
    {
        $this->allCards = [];
        foreach (Card::SUITS as $suit) {
            foreach (Card::VALUES as $value) {
                $this->allCards[] = $value . $suit;
            }
        }
    }

    public function deal(&$allCards, $players, $numCards)
    {
        $hand = array();
        if ($players * $numCards > $this->numCards) {
            return $hand;
        }
        $temp = array_slice($allCards, 0, $players * $numCards);
        $hand = array_chunk($temp, $numCards);
        return $hand;
    }

    public function startGame($players, $cardsAmount)
    {
        shuffle($this->allCards);

        $hands = $this->deal($this->allCards, $players, $cardsAmount);

        foreach ($hands as $cards) {
            foreach ($cards as $c) {
                array_shift($this->allCards);
                $this->gameArray[] = $c;
            }
        }
        $dividedToPlayers = (array_chunk($this->gameArray, $cardsAmount));
        return $dividedToPlayers;
    }

    public function getNumberCards(): int
    {
        if ($this->numCards - count($this->allCards) < 0) {
            return 0;
        } else {
            return count($this->allCards);
        }
    }
}
