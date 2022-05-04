<?php

namespace App\Card;

/**
 * Class Game21
 * @package App\Card;
 * @author Emmie Fahlström
 */
class Game21 implements InterfaceGame21
{
    /**
     * @var object variabel for setting player
     */
    private Player21 $player;

    /**
     * @var object variabel for setting dealer
     */
    private Player21 $dealer;

    /**
     * @var object variabel for deck
     */
    private Deck $deck;


    /**
     * Constructor (creates a new game)
     */
    public function __construct(Player21 $player, Player21 $dealer, Deck $deck)
    {
        $this->player = $player;
        $this->dealer = $dealer;
        $this->deck = $deck;
    }
    /**
     * Resets current player scores and draw new cards
     * @access public
     * @return void
     */
    public function new(): void
    {
        $this->player->resetScore();
        $this->dealer->resetScore();
        $this->deck->shuffleDeck();
        $hit = $this->returnDeck()->draw();
        $hit2 = $this->returnDeck()->draw();
        $hit3 = $this->returnDeck()->draw();
        $this->player->addToCurrentHand($hit);
        $this->player->addToCurrentHand($hit2);
        $this->dealer->addToCurrentHand($hit3);
        $score = $hit->getValueOfCard();
        $score2 = $hit2->getValueOfCard();
        $score3 = $hit3->getValueOfCard();
        $this->player->setScore($score);
        $this->player->setScore($score2);
        $this->dealer->setScore($score3);
    }



    /**
     * Dealers turn to draw card after player is finished
     * @access public
     * @return void
     */
    public function dealersTurn(): void
    {
        while ($this->dealer->getScore() < 17) {
            $hit = $this->returnDeck()->draw();
            $this->dealer->addToCurrentHand($hit);
            $score = $hit->getValueOfCard();
            $this->dealer->setScore($score);
        }
    }


    /**
     * Returns the deck
     * @access public
     * @return Deck
     */
    public function returnDeck(): Deck
    {
        return $this->deck;
    }

    /**
     * Returns the dealer
     * @return Player21
     */
    public function returnDealer(): Player21
    {
        return $this->dealer;
    }

    /**
     * Returns the player
     * @return Player21
     */
    public function returnPlayer(): Player21
    {
        return $this->player;
    }


    /**
     * Checks who is the winner of the game andr returns status
     * @access public
     * @return string
     */
    public function checkStatus(): string
    {
        $playerScore = $this->player->getScore();
        $dealerScore = $this->dealer->getScore();

        if ($dealerScore > 21 || $playerScore === 21) {
            return 'Spelare vinner spelet!';
        } elseif ($playerScore > $dealerScore && $playerScore <= 21) {
            return 'Spelare vinner spelet!';
        } elseif ($dealerScore === $playerScore) {
            return 'Oavgjort';
        } else {
            return 'Dealer vinner spelet!';
        }
    }
}
