<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class Game extends AbstractController
{
    /**
     * @Route("/game/card", name="game21")
     */
    public function player(): Response
    {
        $data = [
            'title' => 'Kortspel 21',
        ];

        return $this->render('card/game21.html.twig', $data);
    }

    /**
     * @Route("/game", name="start-game")
     */
    public function start(): Response
    {
        $data = [
            'title' => 'Kortspel 21',
        ];

        return $this->render('card/start-game.html.twig', $data);
    }

    /**
     * @Route(
     *      "/game/plan",
     *      name="game-plan",
     *      methods={"GET","HEAD"}
     * )
     */
    public function gamePlan(
        SessionInterface $session
    ): Response {
        $card = $session->get("game-plan") ?? new \App\Card\Deck();
        // $game = $session->get("game-plan") ?? new \App\Card\Game21();

        $data = [
            'title' => 'Kortspel 21',
            'card_deck' => $card->draw(),
            'val' => $card->value(),
            // 'dealer' => $game->dealDealer(),
            'counter' => 0
        ];

        $session->set("game-plan", $card);
        return $this->render('card/game-plan.html.twig', $data);
    }

    /**
     * @Route(
     *      "/game/plan",
     *      name="game-plan-process",
     *      methods={"POST"}
     * )
     */
    public function gamePlanProcess(): Response
    {
        // $data = [
        //     'title' => 'Kortspel 21',
        // ];

        // return $this->render('card/game-plan.html.twig', $data);

        return $this->redirectToRoute('game-plan');
    }
}
