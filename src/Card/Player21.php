<?php

namespace App\Card;

use App\Card\Game21;

//class for managing player and dealer
class Player21 implements InterfacePlayer21
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

    public function hit(Card $defaultCard = null): void
    {
        $pulledCard = $defaultCard ?? Card::getTopCardFromDeck();
        $this->currentHand[] = $pulledCard;
        $this->currentScore += $pulledCard->getValueOfCard();
    }

    public function stand(): string
    {
        Game21::handOver();
        $status = Game21::checkStatus();
        return $status;
    }

    public function clearCurrentHand(): void
    {
        $this->currentHand = [];
        $this->currentScore = 0;
    }

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

    public function getCurrentScore($activeHand = true): int
    {
        $score = $this->currentHand[1]->getValueOfCard();
        if (strtolower($this->player) === 'player' || (strtolower($this->player) === 'dealer' && !$activeHand)) {
            $score = $this->currentScore;
        }
        return $score;
    }

    public function dealersTurn(): void
    {
        while ($this->currentScore <= 17) {
            $this->hit();
        }

        Game21::checkStatus();
    }

    public static function getPlayer($player = 'player'): self
    {
        return $_SESSION[$player];
    }
}
