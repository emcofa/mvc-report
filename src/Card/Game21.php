<?php

namespace App\Card;

//class for handling rules and game flow of game 21
class Game21
{
    private $activeGame = false;

    public function __construct()
    {
        if ($this->activeGame == false) {
            $this->activeGame  = true;
            $_SESSION['deck'] = Card::shuffleDeck();
            $_SESSION['player'] = new Player21();
            $_SESSION['dealer'] = new Player21('dealer');
        }

        self::new();
    }

    public static function new()
    {
        $_SESSION['handOver'] = false;

        Player21::getPlayer('player')->clearCurrentHand();
        Player21::getPlayer('dealer')->clearCurrentHand();

        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();
        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();

        self::refresh();
    }

    public static function checkIfGameEnd()
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
        } elseif ($playerScore > $dealerScore) {
            $message = 'Spelare vinner!';
            return $message;
        } elseif ($dealerScore > $playerScore) {
            $message = 'Dealer vinner!';
            return $message;
        } elseif ($dealerScore === $playerScore) {
            $message = 'Samma poäng! Det blev lika.';
            return $message;
        } else {
            $message = 'Error';
            return $message;
        }
    }

    public static function handOver()
    {
        $_SESSION['handOver'] = true;
    }

    public static function refresh()
    {
        header('Location: /');
    }
}
