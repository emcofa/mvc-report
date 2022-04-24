<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{

    /**
     * Test to shuffle deck
     */
    public function testShuffleDeck()
    {
        $deck = new Deck();
        $shuffleDeck1 = $deck->shuffleDeck();
        $shuffleDeck2 = $deck->shuffleDeck();
        $this->assertNotEquals($shuffleDeck1, $shuffleDeck2);
    }
    /**
     * See if deck contains 52 cards
     */
    public function testSizeOfDeck()
    {
        $deck = new Deck();
        $getDeck = $deck->deck();
        $this->assertEquals(count($getDeck), 52);
    }


    /**
     * See if a string card returns
     */

    public function testdrawCard()
    {
        $deck = new Deck();
        $getCard = $deck->draw();
        $this->assertInstanceOf(Card::class, $getCard);
    }

    public function testdrawXAmountOfCards()
    {
        $deck = new Deck();
        $getCard = $deck->drawNumber(4);
        $this->assertEquals(count($getCard), 4);
    }

    public function testGetCardsLeft()
    {
        $deck = new Deck();
        $deck->draw();
        $deck->draw();
        $deck->draw();
        $this->assertEquals($deck->getNumberCards(), 49);
    }
}
