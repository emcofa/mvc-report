<?php

namespace App\Card;

use App\Card\Game21;

//class for managing player and dealer
class Player21
{
    protected $player;
    protected $currentHand;
    protected $currentScore;

    public function __construct($player = 'player')
    {
        $this->player = $player;
        $this->currentHand = [];
        $this->currentScore = 0;
    }

    public function hit(Card $defaultCard = null)
    {
        $pulledCard = $defaultCard ?? Card::getTopCardFromDeck();

        $this->currentHand[] = $pulledCard;
        $this->currentScore += $pulledCard->getValueOfCard();
    }

    public function stand()
    {
        Game21::handOver();
        $status = Game21::checkIfGameEnd();
        return $status;
    }

    public function clearCurrentHand()
    {
        $this->currentHand = [];
        $this->currentScore = 0;
    }

    public function getCurrentHand($activeHand = true)
    {
        $hand = '';
        $i = 0;

        foreach ($this->currentHand as $card) {
            if (strtolower($this->player) === 'dealer' && $activeHand && $i === 0) {
                $hand .= '';
            } else {
                $hand .= $card . ', ';
            }
            $i++;
        }
        return substr($hand, 0, -2);
    }

    public function getCurrentScore($activeHand = true)
    {
        if (strtolower($this->player) === 'player' || (strtolower($this->player) === 'dealer' && !$activeHand)) {
            $score = $this->currentScore;
        } else {
            $score = $this->currentHand[1]->getValueOfCard();
        }
        return $score;
    }

    public function dealersTurn()
    {
        while ($this->currentScore <= 17) {
            $this->hit();
        }

        Game21::checkIfGameEnd();
    }

    public static function getPlayer($player = 'player')
    {
        return $_SESSION[$player];
    }
}
