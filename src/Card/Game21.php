<?php

namespace App\Card;

class Game21
{
    // prints out a deck of cards
    public $DECK = array();
    public $DEALER = array();
    public $PLAYER = array();
    public $numCards = 52;


    public function dealDealer()
    {
        return array_pop($this->DECK) . "," . array_pop($this->DECK);
    }

    public function dealPlayer()
    {
        return array_pop($this->DECK) . "," . array_pop($this->DECK);
    }

    public function dealCard()
    {
        return array_pop($this->DECK);
    }

    public function translateCard($card)
    {
        $face = substr($card, 0, -1);
        $suit = substr($card, -1, 1);
        switch ($suit) {
            case 'C':
                return $face . " of Clubs";
            case 'S':
                return $face . " of Spades";
            case 'H':
                return $face . " of Hearts";
            case 'D':
                return $face . " of Diamonds";
        }
    }
    public function getHandValue($cards)
    {
        $value = 0;
        foreach ($cards as &$values) {
            $value += $this->getCardValue($values);
        }
        return $value;
    }

    public function getCardValue($card)
    {
        $face = substr($card, 0, -1);
        $suit = substr($card, -1, 1);
        $num_pattern = '/[0-9]/';
        $face_pattern = '/[JQK]/';
        if (preg_match($num_pattern, $face)) {
            // This is a number card
            return $face;
        } else if (preg_match($face_pattern, $face)) {
            // This is a regular face card value of 10
            return 10;
        } else {
            // Ace 1 or 12
            return 1;
            echo "ACE.";
        }
        echo "Face: " . $face . "<br />Suit: " . $suit . "<br />";
    }

    /**returns 1 if game is over, 0 if no victory conditions are met**/
    public function winCheck($uValue, $dValue, $stand)
    {
        if ($uValue > 21) {
            /**YOU LOSE**/
            echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";
            return 1;
        } else if ($dValue > 21) {
            /**YOU WIN**/
            echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";
            return 1;
        } else if ($stand == 1) {
            if ($uValue > $dValue) {
                /**YOU WIN**/
                echo "<div style='background-color:green; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Win!!!</div>";
                return 1;
            } else {
                /**YOU LOSE**/
                echo "<div style='background-color:red; text-align:center; color:white; font-size:26px; font-weight:bold; padding:20px;'>You Lose!!!</div>";
                return 1;
            }
        }
        return 0;
    }
}
