<?php

namespace App\Card;

//class for creating deck of Card class
class Deck
{
    public $numCards = 52;
    private $allCards;
    private $deleteCards = [];

    public function __construct()
    {
        $this->allCards = [];
        foreach (Card::SUITS as $suit) {
            foreach (Card::VALUES as $value) {
                $this->allCards[] = $value . $suit;
            }
        }
    }

    public function deck()
    {
        return $this->allCards;
    }

    public function draw()
    {
        if (count($this->allCards) == 0) {
            return;
        }
        shuffle($this->allCards);
        $cards = $this->allCards[0];
        array_shift($this->allCards);

        $this->deleteCards[] = $cards;

        return $cards;
    }

    public function drawNumber(int $number)
    {
        if (count($this->allCards) == 0) {
            return;
        }
        $x = 0;
        while ($x <= $number - 1) {
            shuffle($this->allCards);
            $cards = $this->allCards[0];
            array_shift($this->allCards);
            $this->deleteCards[] = $cards;
            $deleteCards[] = $cards;
            $x++;
        }
        return $deleteCards;
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
