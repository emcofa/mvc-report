<?php

namespace App\Card;

/**
 * Class Deck
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Deck
{
    /**
     * @var int amount of cards in deck
     */
    public $numCards = 52;

    /**
     * @var array an array containing deck
     */
    private $allCards = [];

    /**
     * @var array an array containing cards which has been drawn
     */
    private $deleteCards = [];

    /**
     * Constructor for creating a deck
     */
    public function __construct()
    {
        $this->allCards = [];
        foreach (Card::SUITS as $type) {
            foreach (Card::VALUES as $value) {
                array_push($this->allCards, new Card($type, $value));
            }
        }
    }

    // /**
    //  * @return string Card to string
    //  */
    // public function __toString(): string
    // {
    //     return $this->type . $this->value;
    // }

    /**
     * returns sorted deck
     * @access public
     * @return array
     */
    public function deck(): array
    {
        return $this->allCards;
    }
    /**
     * Shuffles the deck
     * @access public
     * @return array
     */
    public function shuffleDeck(): array
    {
        shuffle($this->allCards);
        return $this->allCards;
    }

    /**
     * Returns the drawn card (Card object)
     * @access public
     * @return Card|string
     */
    public function draw(): Card|string
    {
        if (count($this->allCards) == 0) {
            return "0";
        }
        $cards = $this->allCards[0];
        array_shift($this->allCards);

        return $cards;
    }

    /**
     * Returns the drawn cards
     * @access public
     * @param int $number amount of card which should be drawn
     * @return array
     */
    public function drawNumber(int $number): array
    {
        if (count($this->allCards) == 0) {
            return [];
        }
        $counter = 0;
        while ($counter <= $number - 1) {
            $cards = $this->allCards[0];
            array_shift($this->allCards);
            $this->deleteCards[] = $cards;
            $deleteCards[] = $cards;
            $counter++;
        }

        return $deleteCards;
    }

    /**
     * Returns the number of card containing in the deck
     * @access public
     * @return int
     */
    public function getNumberCards(): int
    {
        if ($this->numCards - count($this->allCards) < 0) {
            return 0;
        }
        return count($this->allCards);
    }
}
