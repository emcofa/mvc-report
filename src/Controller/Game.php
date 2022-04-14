<?php

namespace App\Controller;

use App\Card\Game21;
use App\Card\Player21;
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
        session_start();
        $card = $session->get("deck") ?? new \App\Card\Deck();
        $message = "";

        if (isset($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new';
                    new Game21;
                    $message = "";
                    break;

                case 'hit';
                    Player21::getPlayer()->hit();
                    $message = "";
                    break;

                case 'stand';
                    $message = Player21::getPlayer()->stand();
                    break;

                default;
            }
        }

        if (isset($_SESSION['player']) && isset($_SESSION['dealer'])) {

            $activeHand = ($_SESSION['handOver'] ?? true === true) ? false : true;
            $playerScore = $_SESSION['player']->getCurrentScore();
            $playerHand = $_SESSION['player']->getCurrentHand();
            $dealerScore = $_SESSION['dealer']->getCurrentScore($activeHand);
            $dealerHand = $_SESSION['dealer']->getCurrentHand($activeHand);
        } else {
            $playerScore = 0;
            $playerHand = [];
            $dealerScore = 0;
            $dealerHand = [];
        }

        $data = [
            'title' => 'Kortspel 21',
            'playerScore' => $playerScore,
            // 'playerHand' => $playerHand,
            'playerHand' => explode(", ", $playerHand),
            'dealerScore' => $dealerScore,
            // 'dealerHand' => $dealerHand,
            'dealerHand' => explode(", ", $dealerHand),
            'message' => $message,
        ];

        $session->set("game-plan", $card);
        return $this->render('card/game-plan.html.twig', $data);
    }
}
