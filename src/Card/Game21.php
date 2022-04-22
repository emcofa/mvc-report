<?php

namespace App\Card;

//class for handling rules and game flow of game 21
class Game21
{
    private $activeGame = false;
    private $player;
    private $dealer;

    public function __construct()
    {
        if ($this->activeGame == false) {
            $this->activeGame  = true;
            $this->player = new Player21();
            $this->dealer = new Player21("dealer");
        }
    }

    public function gameStatus()
    {
        return $this->activeGame;
    }

    public function new(): void
    {
        Player21::getPlayer('player')->clearCurrentHand();
        Player21::getPlayer('dealer')->clearCurrentHand();

        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();
        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();

        self::refresh();
    }

    public static function checkStatus()
    {
        $player = Player21::getPlayer();
        $dealer = Player21::getPlayer('dealer');

        $playerScore = $player->getCurrentScore();
        $dealerScore = $dealer->getCurrentScore(false);

        if ($playerScore > 21) {
            $message = 'Spelare tjock! Dealer vinner spelet!';
            return $message;
        } elseif ($dealerScore > 21) {
            $message = 'Dealer tjock! Spelare vinner spelet!';
            return $message;
        } elseif ($playerScore === 21) {
            $message = 'Spelare får 21 och vinner rundan!';
            return $message;
        } elseif ($playerScore === 21 && $dealerScore === 21) {
            $message = 'Spelare och dealer får 21! Det blev lika.';
            return $message;
        } elseif ($dealerScore === 21) {
            $message = 'Dealer får 21 och vinner rundan!';
            return $message;
        } elseif ($playerScore > $dealerScore && $dealerScore < 17) {
            $dealer->dealersTurn();
            $message = 'Dealer nöjd, tryck på knappen igen för att se resultat.';
            return $message;
        } elseif ($playerScore > $dealerScore) {
            $message = 'Spelare vinner!';
            return $message;
        } elseif ($dealerScore > $playerScore) {
            $message = 'Dealer vinner!';
            return $message;
        } elseif ($dealerScore === $playerScore) {
            $message = 'Samma poäng! Det blev lika.';
            return $message;
        }
    }

    public static function refresh()
    {
        header('Location: /');
    }
}
