<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;


/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Test to create card and see if the card is the instance of class
     */
    public function testCreateCard()
    {
        $card = new Card("D", "Jack");
        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Test to see if correct value of card returns (10 for Jack, Queen and King. 11 for Ace)
     */
    public function testValueOfCard()
    {
        $card = new Card("D", "Jack");
        $res = $card->getValueOfCard();
        $this->assertEquals('10', $res);

        $card2 = new Card("H", "Ace");
        $res2 = $card2->getValueOfCard();
        $this->assertEquals('11', $res2);

        $card3 = new Card("S", "5");
        $res3 = $card3->getValueOfCard();
        $this->assertEquals('5', $res3);
    }


    /**
     * Test to see if correct type (suit) of card returns
     */
    public function testTypeOfCard()
    {
        $card = new Card("D", "Jack");
        $res = $card->getTypeOfCard();
        $this->assertEquals('Jack', $res);
    }

    /**
     * Test to see if array of card returns
     */
    public function testShuffleDeck()
    {   
        $shuffleDeck = Card::shuffleDeck();
        $this->assertIsArray($shuffleDeck);
    }

    /**
     * Test to see if a string of the card returns
     */
    public function testStringReturns()
    {   
        $card = new Card("D", "Jack");
        $this->assertEquals('JackD', $card);
    }

    // /**
    //  * Test to see if a card returns from method
    //  */
    // public function testCardFromTopDeck()
    // {   
    //     new Game21();
    //     $card = new Card("D", "Jack");
    //     // $topCard = $card->getTopCardFromDeck();
    //     $this->assertInstanceOf("\App\Card\Card", $topCard);
    // }
}
