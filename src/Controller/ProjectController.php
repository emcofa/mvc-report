<?php

namespace App\Controller;

use App\Controller\LibraryController;
use App\Entity\Project;
use App\Entity\Report2;
use App\Entity\Report3;
use App\Entity\Report4;
use App\Entity\Report5;
use App\Project\Chart5;
use App\Project\Chart3;
use App\Project\Chart1;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
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
        $report1 = $entityManager
            ->getRepository(Project::class)
            ->findAll();
            $chart1 = $chartBuilder->createChart(Chart::TYPE_BAR);
            $tempChart1 = new Chart1($report1);
            $tempChart1->setChart($chart1);
            $title1 = $tempChart1->setHeadlines();
            $title1 = $tempChart1->getHeadlines();

        $report2 = $entityManager
            ->getRepository(Report2::class)
            ->findAll();

        $report3 = $entityManager
            ->getRepository(Report3::class)
            ->findAll();
            $chart3 = $chartBuilder->createChart(Chart::TYPE_LINE);
            $tempChart3 = new Chart3($report3);
            $tempChart3->setChart($chart3);

        $report4 = $entityManager
            ->getRepository(Report4::class)
            ->findAll();

        $report5 = $entityManager
            ->getRepository(Report5::class)
            ->findAll();

            $chart5 = $chartBuilder->createChart(Chart::TYPE_PIE);
            $tempChart5 = new Chart5($report5);
            $tempChart5->setChart($chart5);
            $title5 = $tempChart5->setHeadlines();
            $title5 = $tempChart5->getHeadlines();

        return $this->render('proj/proj.html.twig', [
            'report2' => $report2,
            'report3' => $report3,
            'report4' => $report4,
            'report5' => $report5,
            'chart5' => $chart5,
            'title5' => $title5,
            'chart1' => $chart1,
            'title1' => $title1,
            'chart3' => $chart3,
        ]);
    }

    /**
     * @Route("/proj/reset", name="proj-reset")
     */
    public function projectReset(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'doctrine:database:drop', '--force' => true,
        ]);
        $application->run($input);


        $input = new ArrayInput([
            'command' => 'doctrine:database:create',
        ]);
        $application->run($input);

        $input = new ArrayInput([
            'command' => 'doctrine:schema:update', '--force' => true,
        ]);
        $application->run($input);

        $input = new ArrayInput([
            'command' => 'doctrine:fixtures:load', '--append' => true,
        ]);
        $application->run($input);

        $input = new ArrayInput([
            'command' => 'csv:import',
        ]);
        $application->run($input);


        return $this->redirect($this->generateUrl('proj-about'));
    }

    /**
     * @Route("/proj/cleancode", name="proj-code")
     */
    public function projectCode(): Response
    {
        return $this->render('proj/code.html.twig');
    }
}
