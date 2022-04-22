<?php

namespace App\Card;

/**
 * Class Card
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Card
{
    public const
        /**
         * @var array Suits for Hearts, Diamonds, Clovers and Spades
         */
        SUITS = ['H', 'D', 'C', 'S'],
        /**
         * @var array The values of the cards
         */
        VALUES = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];
    /**
     * @var string variabel for the card suits
     */
    protected $type;

    /**
     * @var string variabel for the card values
     */
    protected $value;

    /**
     * Constructor
     * @param string $type Card suit
     * @param string $Value Card rank
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string Card to string
     */
    public function __toString(): string
    {
        return $this->value . $this->type;
    }

    /**
     * Returns the value of the card
     * @access public
     * @return int
     */
    public function getValueOfCard(): int
    {
        $value = is_numeric($this->value) ? $this->value : 10;
        if (strtolower($this->value) === 'ace') {
            $value = 11;
        }
        return $value;
    }

    /**
     * Returns the type of the card
     * @access public
     * @return string
     */
    public function getTypeOfCard(): string
    {
        return $this->value;
    }

    /**
     * Shuffles the deck
     * @static
     * @access public
     * @return array
     */
    public static function shuffleDeck(): array
    {
        foreach (self::SUITS as $type) {
            foreach (self::VALUES as $value) {
                $deck[] = new static($type, $value);
            }
        }
        shuffle($deck);

        return $deck;
    }

    /**
     * Returns the first card object from deck and then removes the card
     * @static
     * @access public
     * @return Card
     */
    public static function getTopCardFromDeck(): self
    {
        return array_shift($_SESSION['deck']);
    }
}
