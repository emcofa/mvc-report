<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Report extends AbstractController
{
    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        return $this->render('report.html.twig', [
            'index_url' => "/",
            'about_url' => "/about",
            'report_url' => "/report",
        ]);
    }
}
