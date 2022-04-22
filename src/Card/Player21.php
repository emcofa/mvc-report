<?php

namespace App\Card;

use App\Card\Game21;

/**
 * Class Player21
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Player21 implements InterfacePlayer21
{
    /**
     * @var string Can be player or dealer
     */
    protected $player;
    /**
     * @var array An array of card objects ($players hand)
     */
    protected $currentHand;
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
        // echo("inne i konstruktor");
        $this->player = $player;
        $this->currentHand = [];
        $this->currentScore = 0;
    }

    /**
     * Hit a card from the deck and calculate score and add it to players hand
     * @access public
     * @param class $default card null
     * @return void
     */
    public function hit(Card $defaultCard = null): void
    {
        $pulledCard = $defaultCard ?? Card::getTopCardFromDeck();
        $this->currentHand[] = $pulledCard;
        $this->currentScore += $pulledCard->getValueOfCard();
    }

    /**
     * Returns who is the winner of the game
     * @access public
     * @return string
     */
    public function stand(): string
    {
        $status = Game21::checkStatus();
        return $status;
    }

    /**
     * Resets the players hand
     * @access public
     * @return void
     */
    public function clearCurrentHand(): void
    {
        $this->currentHand = [];
        $this->currentScore = 0;
    }

    /**
     * Returns a list of the players hand
     * @access public
     * @param bool $activeHand Dealer only begin with one card, therefore first card is hidden which dealer hits.
     * @return string
     */
    public function getCurrentHand($activeHand = true): string
    {
        $hand = '';
        $counter = 0;

        foreach ($this->currentHand as $card) {
            if (strtolower($this->player) === 'dealer' && $activeHand && $counter === 0) {
                $hand .= '';
            } else {
                $hand .= $card . ', ';
            }

            $counter++;
        }
        return substr($hand, 0, -2);
    }

    /**
    * Returns the score of the players hand
    * @access public
    * @param bool $activeHand Dealer only begin with one card, therefore first card is hidden which dealer hits.
    * @return int
    */
    public function getCurrentScore($activeHand = true): int
    {
        if ($this->currentHand === []) {
            return 0;
        }
        $score = $this->currentHand[1]->getValueOfCard();
        if (strtolower($this->player) === 'player' || (strtolower($this->player) === 'dealer' && !$activeHand)) {
            $score = $this->currentScore;
        }
        return $score;
    }

    /**
    * The dealer draw a new card, at least until he has reached the score 17. After he can decide to draw another one or stand.
    * @access public
    * @return void
    */
    public function dealersTurn(): void
    {
        while ($this->currentScore <= 17) {
            $this->hit();
        }

        Game21::checkStatus();
    }

    /**
    * Get the current player (player or dealer)
    * @static
    * @access public
    * @param string $player Player or dealer
    * @return Player
    */
    public static function getPlayer($player = 'player'): self
    {
        return $_SESSION[$player];
    }
}
