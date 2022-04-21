<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Player21.
 */
class PlayerTest extends TestCase
{
    /**
     * Test to create a new player and see if is instance of Player21 class
     */
    public function testCreatePlayer()
    {
       $player = new Player21;
       $this->assertInstanceOf(Player21::class, $player);
    }

    /**
     * Test to create a dealer and see if is instance of Player21 class
     */
    public function testCreateDealer()
    {
       $dealer = new Player21('dealer');
       $this->assertInstanceOf(Player21::class, $dealer);
    }

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

    /**
     * Test to clear players hand and see if value 0 returns
     */
    public function testToClearPlayersHand()
    {
        $player = new Player21;
        $player->hit(new Card('C', '5'));
        $player->hit(new Card('C', '3'));
        $player->hit(new Card('H', '10'));
        $player->hit(new Card('S', '2'));

        $this->assertSame(20, $player->getCurrentScore());

        $player->clearCurrentHand();

        $this->assertSame(0, $player->getCurrentScore());
    }

    /**
     * Test to get current hand of player
     */
    public function testToGetCurrentHandPlayer()
    {
        $player = new Player21;
        $player->hit(new Card('H', '3'));
        $player->hit(new Card('S', '8'));
        $player->hit(new Card('C', 'King'));

        $this->assertSame("3H, 8S, KingC", $player->getCurrentHand());
    }

    /**
     * Test to get current hand of dealer (first draw should not count)
     */
    public function testToGetCurrentHandDealer()
    {
        $dealer = new Player21('dealer');;
        $dealer->hit(new Card('H', '3'));
        $dealer->hit(new Card('S', 'King'));

        $this->assertSame("KingS", $dealer->getCurrentHand());
    }
}
