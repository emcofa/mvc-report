<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\DeckWith2Jokers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Deck2 extends AbstractController
{
    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $cards = new DeckWith2Jokers();
        $deck = $cards->deck();
        $deck2 = $cards->allCards;
        $toString = [];
        foreach ($deck as $card) {
            array_push($toString, $card->cardToString());
        }
        foreach ($deck2 as $card) {
            array_push($toString, $card->cardToString());
        }
        $data = [
            'title' => 'Spelkort med jokrar',
            'card_deck' => $toString,
        ];

        return $this->render('card/deck2.html.twig', $data);
    }
}
