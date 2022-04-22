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
    public function gamePlan(
        SessionInterface $session,
        Request $request
    ): Response {
        $session->get("deck") ?? Card::shuffleDeck();
        $message = "";

        if ($request->query->get("action")) {
            switch ($request->query->get("action")) {
                case 'new':
                    $session->get("player") ?? new Player21();
                    $session->get("dealer") ?? new Player21('dealer');
                    $game = new Game21();
                    $session->set("handOver", false);
                    $game->new();
                    $message = "";
                    break;

                case 'hit':
                    Player21::getPlayer()->hit();
                    $message = "";
                    break;

                case 'stand':
                    $message = Player21::getPlayer()->stand();
                    $session->set("handOver", true);
                    break;
                default:
            }
        }

        $activeHand = ($session->get("handOver") ?? true === true) ? false : true;
        $data = [
            'title' => 'Kortspel 21',
            'playerScore' => $_SESSION['player']->getCurrentScore(),
            'playerHand' => explode(", ", $_SESSION['player']->getCurrentHand()),
            'dealerScore' => Player21::getPlayer('dealer')->getCurrentScore($activeHand),
            'dealerHand' => explode(", ", Player21::getPlayer('dealer')->getCurrentHand($activeHand)),
            'message' => $message,
        ];

        return $this->render('card/game-plan.html.twig', $data);
    }
}
