<?php

namespace App\Card;

class Game21
{
    public const
      /**
       * @var int The final score in Blackjack
       */
      BLACKJACK = 21;
    private $activeGame = false;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {

         // First hand or just a new hand
            if ($this->activeGame == false) {
                $this->activeGame  = true;

                // Shuffle deck
                $_SESSION['deck'] = Card::shuffleDeck();

                // Generate players
                $_SESSION['player'] = new Player21();
                $_SESSION['dealer'] = new Player21('dealer');
            }

            self::purgeFlash();
            self::new();
        }
    }

    /**
     * Reset player scores and shuffle deck
     * @static
     * @access public
     * @return void
     */
    public static function new()
    {
        $_SESSION['handOver'] = false;

        // Clear hands
        Player21::getPlayer('player')->clearCurrentHand();
        Player21::getPlayer('dealer')->clearCurrentHand();

        // Divvy out two cards each
        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();
        Player21::getPlayer('player')->hit();
        Player21::getPlayer('dealer')->hit();

        self::refresh();
    }

    /**
     * Called after a player hits or stands; this method see who the winner of a hand is
     * @static
     * @access public
     * @return void
     */
    public static function checkForWinner()
    {
        $player = Player21::getPlayer();
        $dealer = Player21::getPlayer('dealer');

        $playerScore = $player->getCurrentScore();
        $dealerScore = $dealer->getCurrentScore(false);

        if ($playerScore > self::BLACKJACK) {
            $dealer->win();
            self::flash('danger', 'Player busted! Dealer wins!');
        } elseif ($dealerScore > self::BLACKJACK) {
            $player->win();
            self::flash('success', 'Dealer busted! Player wins!');
        } elseif ($playerScore === self::BLACKJACK) {
            $player->win();
            self::flash('success', 'Player gets Blackjack!');
        } elseif ($playerScore === self::BLACKJACK && $dealerScore === self::BLACKJACK) {
            self::flash('warning', 'Two Blackjacks! No score change.');
        } elseif ($dealerScore === self::BLACKJACK) {
            $dealer->win();
            self::flash('danger', 'Dealer gets Blackjack!');
        } elseif ($playerScore > $dealerScore && $dealerScore < Player21::DEALERSTANDS) {
            $dealer->dealersTurn();
        } elseif ($playerScore > $dealerScore) {
            $player->win();
            self::flash('success', 'Player wins!');
        } elseif ($dealerScore > $playerScore) {
            $dealer->win();
            self::flash('danger', 'Dealer wins!');
        } elseif ($dealerScore === $playerScore) {
            self::flash('warning', 'Same score! No score change.');
        } else {
            //
        }
    }

    /**
     * Game over
     * @static
     * @access public
     * @return void
     */
    public static function end()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
            self::refresh();
        }
    }

    /**
     * Flashes a message
     * @static
     * @param string $type Type of message; pairs with a Bootstrap CSS class
     * @param string $message Message details of the outcome of a hand
     * @access public
     * @return void
     */
    public static function flash(string $type, string $message)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION['flash']['type'] = $type;
            $_SESSION['flash']['message'] = $message;

            self::handOver();
            self::refresh();
        }
    }

    /**
     * Purges flash message from session scope- generally called when a new hand has started
     * @static
     * @access public
     * @return void
     */
    public static function purgeFlash()
    {
        unset($_SESSION['flash']);
    }

    /**
     * Responsible for indicating that a hand is over so the dealer can determine next steps
     * as well as revealing the dealer's hand
     * @static
     * @access public
     * @return void
     */
    public static function handOver()
    {
        $_SESSION['handOver'] = true;
    }

    /**
     * Responsible for refreshing the page to indicate session changes
     * @static
     * @access public
     * @return void
     */
    public static function refresh()
    {
        header('Location: /');
    }

    /**
     * Checks to make sure a session is valid and active prior to executing game actions
     * @static
     * @access public
     * @return void
     */
    public static function checkForValidSession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            self::flash('warning', 'Invalid session or your session has expired.  Ending game.');
        }
    }
}
