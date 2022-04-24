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
        $player = new Player21("player");
        $dealer = new Player21("dealer");
        $deck = new Deck();
        $game = new Game21($player, $dealer, $deck);
        $this->assertEquals($game->returnPlayer(), $player);
        $this->assertEquals($game->returnDealer(), $dealer);
        $this->assertEquals($game->returnDeck(), $deck);
    }

    public function testInstanceClassGame21()
    {   
        $player = new Player21("player");
        $dealer = new Player21("dealer");
        $deck = new Deck();
        $game = new Game21($player, $dealer, $deck);
        $this->assertInstanceOf(Game21::class, $game);
    }

    public function testNewGame21()
    {   
        $player = new Player21("player");
        $dealer = new Player21("dealer");
        $deck = new Deck();
        $game = new Game21($player, $dealer, $deck);
        $game->new();
        $res = $player->returnCurrentHand();
        $this->assertEquals(count($res), 2);
        $res2 = $dealer->returnCurrentHand();
        $this->assertEquals(count($res2), 1);
        $res3 = $player->getScore();
        $this->assertNotEquals($res3, 0);
    }

    public function testDealersTurn()
    {   
        $player = new Player21("player");
        $dealer = new Player21("dealer");
        $deck = new Deck();
        $game = new Game21($player, $dealer, $deck);
        $game->new();
        $game->dealersTurn();
        $res = $player->returnCurrentHand();
        $this->assertNotEquals(count($res), 1);
    }

    public function testStatus()
    {   
        $player = new Player21("player");
        $dealer = new Player21("dealer");
        $deck = new Deck();
        $game = new Game21($player, $dealer, $deck);
        $game->new();
        $game->dealersTurn();
        $res = $game->checkStatus();
        $this->assertIsString($res);
    }
}
