<?php

namespace App\Project;

use App\Entity\Project;
use PHPUnit\Framework\TestCase;
use App\Repository\ProjectRepository;



/**
 * Test cases for class Chart1.
 */
class Chart1Test extends TestCase
{
    /**
     * Test to Chart 1 see if correct instance returns with correct title and datasets
     */
    public function testChart1()
    {

        $proj = new Project();
        $proj->setYear("2016");
        $proj->setWomen(5.6);
        $proj->setMen(9.7);
        $toArray = [$proj];

        // Now, mock the repository so it returns the mock of the employee
        $projRepository = $this->createMock(ProjectRepository::class);

        $projRepository->expects($this->any())
            ->method('find')
            ->willReturn($proj);
        $chart1 = new Chart1($toArray);

        $this->assertInstanceOf(Chart1::class, $chart1);
        $this->assertIsArray($chart1->getYear());
        $this->assertIsArray($chart1->getWomen());
        $this->assertIsArray($chart1->getMen());
    }
};
