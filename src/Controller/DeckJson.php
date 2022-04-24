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
        $cards = [];
        $deck = new Deck();
        $new = $deck->deck();

        for ($counter = 0, $length = count($new); $counter < $length; $counter++) {
            array_push($cards, $new[$counter]->cardToString());
        }
        $data = [
            'title' => 'Playing cards',
            'card_deck' => $cards,
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
