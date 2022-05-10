<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


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
        EntityManagerInterface $entityManager
    ): Response {
        $project = $entityManager
            ->getRepository(Project::class)
            ->findAll();

        return $this->render('proj/proj.html.twig', [
            'project' => $project,
        ]);
    }
}
