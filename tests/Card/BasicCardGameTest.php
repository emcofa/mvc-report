<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class BasicCardGameTest extends TestCase
{
    /**
     * Test to create card and see if the card is the instance of class
     */
    public function testCreateDeckInstance()
    {
        $game = new BasicCardGame();
        $this->assertInstanceOf("\App\Card\BasicCardGame", $game);
    }

    /**
     * Test to deal cards to players
     */
    public function testDeal()
    {
        $game = new BasicCardGame();
        $deal = $game->startGame(2, 4);
        $this->assertIsArray($deal);
    }

    /**
     * Test to deal cards to players and see if correct amount of cards return
     */
    public function testCountCards()
    {
        $game = new BasicCardGame();
        $deal = $game->startGame(2, 5);
        $count = $game->getNumberCards();
        $this->assertEquals(42, $count);
    }
}
