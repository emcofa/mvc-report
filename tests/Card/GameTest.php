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

        // // $player = new Player21();
        // // $dealer = new Player21("dealer");
        // $refresh = Game21::refresh();
        // $this->assertEquals($refresh, true);
    }
}
