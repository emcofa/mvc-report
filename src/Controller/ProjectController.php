<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Report2;
use App\Entity\Report3;
use App\Entity\Report5;
use App\Project\Chart5;
use App\Project\Chart3;
use App\Project\Chart1;
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
        return $this->render('proj/about-proj.html.twig');
    }

    /**
     * @Route("/proj", name="proj")
     */
    public function project(
        EntityManagerInterface $entityManager,
        ChartBuilderInterface $chartBuilder
    ): Response {
        $report1 = $this->report1($entityManager, $chartBuilder);

        $report2 = $this->report2($entityManager);

        $report3 = $this->report3($entityManager, $chartBuilder);

        $report5 = $this->report5($entityManager, $chartBuilder);

        return $this->render('proj/proj.html.twig', [
            'chart1' => $report1,
            'report2' => $report2,
            'report3' => $report3[0],
            'report5' => $report5[0],
            'chart3' => $report3[1],
            'chart5' => $report5[1],
        ]);
    }

    /**
     * Get the data of report 1
     * @return mixed
     */
    public function report1($entityManager, $chartBuilder): mixed
    {
        $report1 = $entityManager
            ->getRepository(Project::class)
            ->findAll();
        $chart1 = $chartBuilder->createChart(Chart::TYPE_BAR);
        $tempChart1 = new Chart1($report1);
        $tempChart1->setChart($chart1);
        return $chart1;
    }

    /**
     * Get the data of report 2
     * @return mixed
     */
    public function report2($entityManager): mixed
    {
        $report2 = $entityManager
            ->getRepository(Report2::class)
            ->findAll();
        return $report2;
    }

    /**
     * Get the data of report 3
     * @return array<mixed>
     */
    public function report3($entityManager, $chartBuilder): array
    {
        $report3 = $entityManager
            ->getRepository(Report3::class)
            ->findAll();
        $chart3 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $tempChart3 = new Chart3($report3);
        $tempChart3->setChart($chart3);
        return [$report3, $chart3];
    }

    /**
     * Get the data of report 5
     * @return array<mixed>
     */
    public function report5($entityManager, $chartBuilder): array
    {
        $report5 = $entityManager
            ->getRepository(Report5::class)
            ->findAll();
        $chart5 = $chartBuilder->createChart(Chart::TYPE_PIE);
        $tempChart5 = new Chart5($report5);
        $tempChart5->setChart($chart5);
        return [$report5, $chart5];
    }

    /**
     * @Route("/proj/cleancode", name="proj-code")
     */
    public function projectCode(): Response
    {
        return $this->render('proj/code.html.twig');
    }
}
