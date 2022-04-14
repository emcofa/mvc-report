<?php

namespace App\Controller;

use App\Card\Deck;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DeckJson
{
    /**
     * @Route("/card/api/deck")
     */
    public function deck(): Response
    {
        $card = new Deck();
        $data = [
            'title' => 'Playing cards',
            'card_deck' => $card->deck(),
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
