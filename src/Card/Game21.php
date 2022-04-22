<?php

namespace App\Card;

/**
 * Class Game21
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Game21
{
    /**
     * @var bool variabel for setting if game is active or not
     */
    private $activeGame = false;


    /**
     * Constructor (creates new players)
     */
    public function __construct()
    {
        if ($this->activeGame == false) {
            $this->activeGame  = true;
            // $_SESSION['deck'] = Card::shuffleDeck();
            $this->player = new Player21();
            $this->dealer = new Player21("dealer");
        }
    }

    /**
     * @return bool checks game status
     */
    public function gameStatus(): bool
    {
        return $this->activeGame;
    }

    /**
     * Resets current hands and player scores
     * @access public
     * @return void
     */
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

    /**
     * Checks who is the winner of the game
     * @static
     * @access public
     * @return string
     */
    public static function checkStatus(): string
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

    /**
     * Refreshing the page
     * @static
     * @access public
     * @return void
     */
    public static function refresh(): void
    {
        header('Location: /');
    }
}
