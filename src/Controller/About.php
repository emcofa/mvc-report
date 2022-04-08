<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class About extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about.html.twig', [
            'index_url' => "~emfh21/dbwebb-kurser/mvc/me/report/public/",
            'about_url' => "~emfh21/dbwebb-kurser/mvc/me/report/public/about",
            'report_url' => "~emfh21/dbwebb-kurser/mvc/me/report/public/report",
        ]);
    }
}
