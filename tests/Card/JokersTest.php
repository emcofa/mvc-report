<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class DeckWith2JokersTest extends TestCase
{
    /**
     * Test to create card and see if the card is the instance of class
     */
    public function testCreateDeckInstanceJokers()
    {
        $game = new DeckWith2Jokers();
        $this->assertInstanceOf("\App\Card\DeckWith2Jokers", $game);
    }
}
