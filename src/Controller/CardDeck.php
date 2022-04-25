<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\Deck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardDeck extends AbstractController
{
    /**
     * @Route("/card/deck", name="deck")
     */
    public function deck(): Response
    {
        $cards = new Deck();
        $deck = $cards->deck();
        $toString = [];
        foreach ($deck as $card) {
            array_push($toString, $card->cardToString());
        }
        $data = [
            'title' => 'Spelkort (sorterade i färg och värde)',
            'card_deck' => $toString,
        ];

        return $this->render('card/deck.html.twig', $data);
    }


    /**
     * @Route("/card/deck/shuffle", name="card-deck-shuffle")
     */
    public function cardDeckShuffle(
        SessionInterface $session
    ): Response {
        $session->clear();
        $deck = $session->get("deck") ?? new Deck();
        $shuffle = $deck->shuffleDeck();
        $toString = [];
        foreach ($shuffle as $card) {
            array_push($toString, $card->cardToString());
        }
        $data = [
            'title' => 'Spelkort (osorterade)',
            'card_deck' => $toString,
        ];

        $session->set("deck", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function cardDeckDraw(
        SessionInterface $session
    ): Response {
        $card = $session->get("deck") ?? new Deck();
        $drawn = $card->draw();
        $data = [
            'title' => 'Du drog följande:',
            'card_deck' => $drawn->cardToString(),
            'count' => $card->getNumberCards(),
        ];

        $session->set("deck", $card);

        return $this->render('card/draw.html.twig', $data);
    }


    /**
     * @Route("/card/deck/draw/{number}", name="drawNumber")
     */
    public function drawNumber(
        int $number,
        SessionInterface $session,
    ): Response {
        $card = $session->get("deck") ?? new Deck();
        $drawn = $card->drawNumber($number);
        $toString = [];
        foreach ($drawn as $drawnCard) {
            array_push($toString, $drawnCard->cardToString());
        }
        $data = [
            'title' => 'Du drog följande:',
            'number' => $number,
            'card_deck' => $toString,
            'count' => $card->getNumberCards(),
        ];
        $session->set("deck", $card);

        return $this->render('card/draw-number.html.twig', $data);
    }
}
