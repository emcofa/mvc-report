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

    protected $playerScore = 0;
    protected $playerHand = [];
    protected $dealerScore = 0;
    protected $dealerHand = [];
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
        $session->get("player") ?? new Player21();
        $session->get("dealer") ?? new Player21('dealer');
        $message = "";

        if ($request->query->get("action")) {
            switch ($request->query->get("action")) {
                case 'new':
                    $game = new Game21();
                    $game->new();
                    $message = "";
                    break;

                case 'hit':
                    Player21::getPlayer()->hit();
                    $message = "";
                    break;

                case 'stand':
                    $message = Player21::getPlayer()->stand();
                    break;
                default:
            }
        }
        $var = $request->query->get("action");
        var_dump($var);
        // if (isset($_SESSION['player']) && isset($_SESSION['dealer'])) {
        $activeHand = ($_SESSION['handOver'] ?? true === true) ? false : true;
        $this->playerScore = $_SESSION['player']->getCurrentScore();
        $this->playerHand = $_SESSION['player']->getCurrentHand();
        $this->dealerScore = $_SESSION['dealer']->getCurrentScore($activeHand);
        $this->dealerHand = $_SESSION['dealer']->getCurrentHand($activeHand);
        // }

        $data = [
            'title' => 'Kortspel 21',
            'playerScore' => $this->playerScore,
            'playerHand' => explode(", ", $this->playerHand),
            'dealerScore' => $this->dealerScore,
            'dealerHand' => explode(", ", $this->dealerHand),
            'message' => $message,
        ];

        return $this->render('card/game-plan.html.twig', $data);
    }
}
