<?php

namespace App\Controller;

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
        $card = new \App\Card\Deck();
        $data = [
            'title' => 'Spelkort (sorterade i färg och värde)',
            'card_deck' => $card->deck(),
        ];

        return $this->render('card/deck.html.twig', $data);
    }


    /**
     * @Route("/card/deck/shuffle", name="card-deck-shuffle")
     */
    public function cardDeckShuffle(
        SessionInterface $session
    ): Response {
        $card = $session->get("deck") ?? new \App\Card\Deck();
        session_destroy();
        $cards = $card->deck();
        $data = [
            'title' => 'Spelkort (osorterade)',
            'card_deck' => $card->shuffle($cards),
        ];

        $session->set("deck", $card);

        return $this->render('card/deck.html.twig', $data);
    }


    /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function cardDeckDraw(
        SessionInterface $session
    ): Response {

        $card = $session->get("deck") ?? new \App\Card\Deck();

        $data = [
            'title' => 'Du drog följande:',
            'card_deck' => $card->draw(),
            'count' => $card->getNumberCards(),
            // 'die_as_string' => $die->getAsString(),
            // 'link_to_roll' => $this->generateUrl('dice-graphic-roll', ['numRolls' => 5,]),
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
        Request $request
    ): Response {
        $card = $session->get("deck") ?? new \App\Card\Deck();

        $data = [
            'title' => 'Du drog följande:',
            'number' => $number,
            'card_deck' => $card->drawNumber($number),
            'count' => $card->getNumberCards(),
        ];
        $session->set("deck", $card);

        return $this->render('card/draw-number.html.twig', $data);
    }
}

