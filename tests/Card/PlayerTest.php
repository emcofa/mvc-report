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
        $player = new Player21();
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
     * Test to create card hand
     */
    public function testCreateHand()
    {
        $player = new Player21("player");
        $card1 = new Card("D", "Jack");
        $card2 = new Card("H", "9");
        $card3 = new Card("S", "Ace");
        $player->addToCurrentHand($card1);
        $player->addToCurrentHand($card2);
        $player->addToCurrentHand($card3);
        $res = $player->returnCurrentHand();
        $this->assertEquals([$card1, $card2, $card3], $res);
    }

    /**
     * Test to set score for player
     */
    public function testSetScorePlayer()
    {
        $player = new Player21("player");
        $player->setScore(6);
        $player->setScore(9);
        $player->setScore(2);
        $totalScore = $player->getScore();
        $this->assertEquals(17, $totalScore);
    }

    /**
     * Test to set score dealer
     */
    public function testSetScoreDealer()
    {
        $player = new Player21("dealer");
        $player->setScore(6);
        $player->setScore(10);
        $player->setScore(11);
        $totalScore = $player->getScore();
        $this->assertEquals(27, $totalScore);
    }

    /**
    * Test to reset score
    */
    public function testResetScore()
    {
        $player = new Player21("player");
        $player->setScore(6);
        $player->setScore(10);
        $player->setScore(11);
        $totalScore = $player->getScore();
        $this->assertEquals(27, $totalScore);
        $player->resetScore();
        $totalScore2 = $player->getScore();
        $this->assertEquals(0, $totalScore2);
    }

    // /**
   //  * Test to create a player and draw three dressed cards and one Ace and get the total score of the cards
   //  */
   // public function testGetRightScoreDressedCardsAndAce()
   // {
   //     $player = new Player21;
   //     $player->hit(new Card('D', 'Jack'));
   //     $player->hit(new Card('H', 'King'));
   //     $player->hit(new Card('C', 'Ace'));
   //     $player->hit(new Card('S', 'Queen'));
   //     $this->assertSame(41, $player->getCurrentScore());
   // }

   // /**
   //  * Test to create a dealer and return correct score. (First score is hidden since dealer only draw one card in the beginning).
   //  */
   // public function testDealerScore()
   // {
   //     $dealer = new Player21('dealer');
   //     $dealer->hit(new Card('H', 'King'));
   //     $dealer->hit(new Card('H', '2'));
   //     $this->assertSame(2, $dealer->getCurrentScore());
   // }

   // /**
   //  * Test to clear players hand and see if value 0 returns
   //  */
   // public function testToClearPlayersHand()
   // {
   //     $player = new Player21;
   //     $player->hit(new Card('C', '5'));
   //     $player->hit(new Card('C', '3'));
   //     $player->hit(new Card('H', '10'));
   //     $player->hit(new Card('S', '2'));

   //     $this->assertSame(20, $player->getCurrentScore());

   //     $player->clearCurrentHand();

   //     $this->assertSame(0, $player->getCurrentScore());
   // }

   //     /**
   //      * Test to get current hand of player
   //      */
   //     public function testToGetCurrentHandPlayer()
   //     {
   //         $player = new Player21;
   //         $player->hit(new Card('H', '3'));
   //         $player->hit(new Card('S', '8'));
   //         $player->hit(new Card('C', 'King'));

   //         $this->assertSame("3H, 8S, KingC", $player->getCurrentHand());
   //     }

   //     /**
   //      * Test to get current hand of dealer (first draw should not count)
   //      */
   //     public function testToGetCurrentHandDealer()
   //     {
   //         $dealer = new Player21('dealer');;
   //         $dealer->hit(new Card('H', '3'));
   //         $dealer->hit(new Card('S', 'King'));

   //         $this->assertSame("KingS", $dealer->getCurrentHand());
   //     }
}
