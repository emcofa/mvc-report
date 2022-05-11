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
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;


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
        ChartBuilderInterface $chartBuilder
    ): Response {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

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
            'chart' => $chart,
        ]);
    }
}
