<?php

namespace App\Card;

/**
 * Class BasicCardGame
 * @package App\Card;
 * @author Emmie Fahlström
 */
class BasicCardGame
{
    /**
     * @var int amount of cards in deck
     */
    public $numCards = 52;
    /**
     * @var array an array containing deck
     */
    private $allCards;
    /**
     * @var array an array containing the drawn cards and should be divided to the players
     */
    private $gameArray = [];

    /**
     * Constructor for creating a deck
     */
    public function __construct()
    {
        $this->allCards = [];
        foreach (Card::SUITS as $suit) {
            foreach (Card::VALUES as $value) {
                $this->allCards[] = $value . $suit;
            }
        }
    }

    /**
     * Deal x amount of cards to x amount of players
     * @access public
     * @param array $allCards all cards in the array
     * @param int $players how many players who is playing the game
     * @param int $numCards how many cards which should be drawn
     * @return array
     */
    public function deal(&$allCards, $players, $numCards): array
    {
        $hand = array();
        if ($players * $numCards > $this->numCards) {
            return $hand;
        }
        $temp = array_slice($allCards, 0, $players * $numCards);
        $hand = array_chunk($temp, $numCards);
        return $hand;
    }

    /**
     * Start the game
     * @access public
     * @param int $players how many players who is playing the game
     * @param int $cardsAmount how many cards which should be drawn
     * @return array
     */
    public function startGame($players, $cardsAmount): array
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
