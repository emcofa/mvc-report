<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class Player extends AbstractController
{
    /**
     * @Route("/card/deck/deal/{players}/{cards}", name="gamePlayer")
     */
    public function player(
        int $players,
        int $cards
    ): Response
    {
        $card = new \App\Card\CardHand();
        $data = [
            'title' => 'Kortspel',
            'players' => $players,
            'cards' => $cards,
            'game' => $card->startGame($players, $cards),
            'counter' => 1,
            'count' => $card->getNumberCards(),
        ];

        return $this->render('card/game.html.twig', $data);
    }
}