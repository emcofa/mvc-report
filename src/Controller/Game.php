<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\Game21;
use App\Card\Player21;
use App\Card\Deck;
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
    public function new(
        SessionInterface $session
    ): Response {
        $session->clear();
        $player = new Player21("Player");
        $dealer = new Player21("Dealer");
        $deck = new Deck();
        $game = $session->get("game") ?? new Game21($player, $dealer, $deck);
        $game->new();
        $session->set("game", $game);

        $data = [
            'playerScore' => $game->returnPlayer()->getScore(),
            'playerHand' => $player->returnCurrentHandString(),
            'dealerScore' => $game->returnDealer()->getScore(),
            'dealerHand' => $dealer->returnCurrentHandString(),
            'message' => "",
        ];

        return $this->render('card/game-plan.html.twig', $data);
    }

    /**
     * @Route("/hit", name="hit")
     */
    public function hit(SessionInterface $session): Response
    {
        $game = $session->get("game");
        $hit = $game->returnDeck()->draw();
        $game->returnPlayer()->addToCurrentHand($hit);
        $score = $hit->getValueOfCard();
        $game->returnPlayer()->setScore($score);
        $session->set("game", $game);

        $data = [
            'playerScore' => $game->returnPlayer()->getScore(),
            'playerHand' => $game->returnPlayer()->returnCurrentHandString(),
            'dealerScore' => $game->returnDealer()->getScore(),
            'dealerHand' => $game->returnDealer()->returnCurrentHandString(),
            'message' => "",
        ];

        return $this->render('card/game-plan.html.twig', $data);
    }

    /**
     * @Route("/stand", name="stand")
     */
    public function stand(SessionInterface $session): Response
    {
        $game = $session->get("game");
        $game->dealersTurn();
        $message = $game->checkStatus();

        $session->set("game", $game);

        $data = [
            'playerScore' => $game->returnPlayer()->getScore(),
            'playerHand' => $game->returnPlayer()->returnCurrentHandString(),
            'dealerScore' => $game->returnDealer()->getScore(),
            'dealerHand' => $game->returnDealer()->returnCurrentHandString(),
            'message' => $message,
        ];

        return $this->render('card/game-plan.html.twig', $data);
    }
}
