<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21.
 */
class GameTest extends TestCase
{

    /**
     * Test to start a new game
     */
    public function testStartGame()
    {
        $game = new Game21();
        $this->assertEquals($game->gameStatus(), true);
    }

    public function testNewGame()
    {   
        $game = new Game21();
        // $refresh = Game21::refresh();
        $this->assertInstanceOf(Game21::class, $game);
    }

    /**
     * Construct object, plays the game and dealer wins.
     */
    public function testPlayDealerWins()
    {   
        Card::shuffleDeck();
        $game = new Game21();
        // $player = new Player21();
        // $player->hit(new Card('S', '10'));
        // $player->hit(new Card('H', 'ACE'));
        // $dealer = new Player21('dealer');
        // $dealer->hit(new Card('S', '8'));
        // $dealer->hit(new Card('H', '8'));
        // $dealer->hit(new Card('H', '3'));
        $this->assertEquals($game->new(), 'Spelare');
    }
}
