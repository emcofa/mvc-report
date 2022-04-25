<?php

namespace App\Controller;

use App\Card\Deck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeckWith2Jokers extends CardDeck
{
    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $cards = new Deck();
        $deck = $cards->deck();
        $toString = [];
        foreach ($deck as $card) {
            array_push($toString, $card->cardToString());
        }
        $data = [
            'title' => 'Spelkort med jokrar',
            'card_deck' => $toString,
            'add_joker_to_deck' => 'j',
        ];

        return $this->render('card/deck2.html.twig', $data);
    }
}
