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

        if (isset($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new';
                    new Game21;
                    break;

                // case 'end';
                //     $playerHand = [];
                //     $dealerScore = [];
                //     Game21::end();
                //     break;

                case 'hit';
                    Player21::getPlayer()->hit();
                    break;

                case 'stand';
                    Player21::getPlayer()->stand();
                    break;

                default;
            }
        }

        // Pass values back to "view"
        if (isset($_SESSION['player']) && isset($_SESSION['dealer'])) {

            $activeHand = ($_SESSION['handOver'] ?? true === true) ? false : true;

            $playerScore = $_SESSION['player']->getCurrentScore();
            $playerHand = $_SESSION['player']->getCurrentHand();
            $playerWins = $_SESSION['player']->getTotalWins();

            $dealerScore = $_SESSION['dealer']->getCurrentScore($activeHand);
            $dealerHand = $_SESSION['dealer']->getCurrentHand($activeHand);
            $dealerWins = $_SESSION['dealer']->getTotalWins();
        } else {
            $playerScore = 0;
            $playerHand = [];
            $playerWins = 0;

            $dealerScore = 0;
            $dealerHand = [];
            $dealerWins = 0;
        }

        $data = [
            'title' => 'Kortspel 21',
            // 'activeHand' => $activeHand,
            'playerScore' => $playerScore,
            // 'playerHand' => $playerHand,
            'playerHand' => explode(", ",$playerHand),
            'playerWins' => $playerWins,
            'dealerScore' => $dealerScore,
            // 'dealerHand' => $dealerHand,
            'dealerHand' => explode(", ",$dealerHand),
            'dealerWins' => $dealerWins,
            'session' => $_SESSION,
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
