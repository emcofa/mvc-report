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
     * @param string $value Card rank
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Returns the value of the card
     * @access public
     * @return int|string
     */
    public function getValueOfCard(): int|string
    {
        $value = is_numeric($this->value) ? $this->value : 10;
        if (strtolower($this->value) === 'ace') {
            $value = 11;
        }
        return $value;
    }
    /**
    * returns string card
    * @return string returns string card
    */
    public function cardToString(): string
    {
        return  $this->value . $this->type;
    }
}
