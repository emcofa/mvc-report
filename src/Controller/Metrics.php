<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Metrics extends AbstractController
{
    /**
     * @Route("/metrics", name="metrics")
     */
    public function metrics(): Response
    {
        return $this->render('metrics/index.html.twig', [
            'index_url' => "/",
            'about_url' => "/about",
            'report_url' => "/report",
        ]);
    }
}
