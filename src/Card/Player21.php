<?php

namespace App\Card;

/**
 * Class Player21
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Player21
{
    /**
     * @var string Can be player or dealer.
     */
    protected $player;
    /**
     * @var array<string> An array of card objects ($players hand)
     */
    protected $currentHand;

    /**
     * @var array<string> An array of cards (string) ($players hand)
     */
    protected $currentHandString;

    /**
     * @var int Total score of $players hand
     */
    protected $currentScore;

    /**
     * Constructor
     * @param string $player can be player or dealer
     */
    public function __construct($player = 'player')
    {
        $this->player = $player;
        $this->currentHand = [];
        $this->currentHandString = [];
        $this->currentScore = 0;
    }

    /**
     * Adds pulled card to the current hand
     * @param $pulledCard pulled card
     * @access public
     * @return void
     */
    public function addToCurrentHand($pulledCard): void
    {
        array_push($this->currentHand, $pulledCard);
        array_push($this->currentHandString, $pulledCard->cardToString());
    }

    /**
     * Returns current hand
     * @access public
     * @return array<string> the current hand
     */
    public function returnCurrentHand(): array
    {
        return $this->currentHand;
    }

    /**
     * Returns current hand in a string
     * @access public
     * @return array<string> the current hand
     */
    public function returnCurrentHandString(): array
    {
        return $this->currentHandString;
    }

    /**
     * Sets the score for player and dealer
     *
     * @param int $currentScore adds the score to the scoreboard.
     * @access public
     * @return void
     */
    public function setScore(int $currentScore): void
    {
        $this->currentScore = $this->currentScore + $currentScore;
    }

    /**
     * Resetsthe score for player and dealer
     * @access public
     * @return void
     */
    public function resetScore(): void
    {
        $this->currentScore  = 0;
    }

    /**
     * Get total score of player and dealer
     * @access public
     * @return int The total score of the player and dealer
     */
    public function getScore(): int
    {
        return $this->currentScore;
    }
}
