<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DeckWith2Jokers extends CardDeck
{
    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $card = new \App\Card\Deck();
        $data = [
            'title' => 'Spelkort med jokrar',
            'card_deck' => $card->deck(),
            'joker' => 'j',
        ];

        return $this->render('card/deck2.html.twig', $data);
    }
}
