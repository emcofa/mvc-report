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
        $handover = Game21::handOver();
        $this->assertEquals($handover, false);
    }
}
