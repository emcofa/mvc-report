<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Test to create card and see if the card is in the deck
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $getDeck = $deck->deck();
        $this->assertContains("10C", $getDeck);
        $this->assertContains("4H", $getDeck);
        $this->assertContains("AceS", $getDeck);
        $this->assertContains("QueenD", $getDeck);
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
}
