<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Player21.
 */
class PlayerTest extends TestCase
{
    /**
     * Test to create a player and draw two numeric cards and get the total score of the cards
     */
    public function testGetRightScoreNumCards()
    {
        $player = new Player21;
        $player->hit(new Card('S', '4'));
        $player->hit(new Card('H', '8'));
        $this->assertSame(12, $player->getCurrentScore());
    }

    /**
     * Test to create a player and draw three dressed cards and one Ace and get the total score of the cards
     */
    public function testGetRightScoreDressedCardsAndAce()
    {
        $player = new Player21;
        $player->hit(new Card('D', 'Jack'));
        $player->hit(new Card('H', 'King'));
        $player->hit(new Card('C', 'Ace'));
        $player->hit(new Card('S', 'Queen'));
        $this->assertSame(41, $player->getCurrentScore());
    }

    /**
     * Test to create a dealer and return correct score. (First score is hidden since dealer only draw one card in the beginning).
     */
    public function testDealerScore()
    {
        $dealer = new Player21('dealer');
        $dealer->hit(new Card('H', 'King'));
        $dealer->hit(new Card('H', '2'));
        $this->assertSame(2, $dealer->getCurrentScore());
    }

    public function testClearPlayerHand()
    {
        $player = new Player21;

        $player->hit(new Card('diamond', '2'));
        $player->hit(new Card('club', '6'));
        $player->hit(new Card('spade', '10'));
        $player->hit(new Card('heart', 'Ace'));

        $this->assertSame(29, $player->getCurrentScore());

        $player->clearCurrentHand();

        $this->assertSame(0, $player->getCurrentScore());
    }
}
