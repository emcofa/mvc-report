<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Report2;
use App\Entity\Report3;
use App\Entity\Report4;
use App\Entity\Report5;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj/about", name="proj-about")
     */
    public function projectAbout(): Response
    {
        return $this->render('proj/about-proj.html.twig', [
            'index_url' => "/",
            'about_url' => "/about",
            'report_url' => "/report",
        ]);
    }

    /**
     * @Route("/proj", name="proj")
     */
    public function project(
        EntityManagerInterface $entityManager,
    ): Response {

        $report1 = $entityManager
            ->getRepository(Project::class)
            ->findAll();

        $report2 = $entityManager
            ->getRepository(Report2::class)
            ->findAll();

        $report3 = $entityManager
            ->getRepository(Report3::class)
            ->findAll();

        $report4 = $entityManager
            ->getRepository(Report4::class)
            ->findAll();

        $report5 = $entityManager
            ->getRepository(Report5::class)
            ->findAll();

        return $this->render('proj/proj.html.twig', [
            'report1' => $report1,
            'report2' => $report2,
            'report3' => $report3,
            'report4' => $report4,
            'report5' => $report5,
        ]);
    }
}
