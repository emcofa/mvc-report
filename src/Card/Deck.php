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

    public function deck(): array
    {
        return $this->allCards;
    }

    public function draw(): string
    {
        if (count($this->allCards) == 0) {
            return "0";
        }
        shuffle($this->allCards);
        $cards = $this->allCards[0];
        array_shift($this->allCards);

        $this->deleteCards[] = $cards;

        return $cards;
    }

    public function drawNumber(int $number): array
    {
        if (count($this->allCards) == 0) {
            return [];
        }
        $counter = 0;
        while ($counter <= $number - 1) {
            shuffle($this->allCards);
            $cards = $this->allCards[0];
            array_shift($this->allCards);
            $this->deleteCards[] = $cards;
            $deleteCards[] = $cards;
            $counter++;
        }
        return $deleteCards;
    }

    public function getNumberCards(): int
    {
        if ($this->numCards - count($this->allCards) < 0) {
            return 0;
        }
        return count($this->allCards);
    }
}
