<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;

class ResetDatabase extends AbstractController
{
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
}
