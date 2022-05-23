<?php

namespace App\Project;

use App\Entity\Report5;
use PHPUnit\Framework\TestCase;
use App\Repository\Report5Repository;



/**
 * Test cases for class Chart5.
 */
class Chart5Test extends TestCase
{
    /**
     * Test to Chart 5 see if correct instance returns with correct title and datasets
     */
    public function testChart5()
    {

        $proj = new Report5();
        $proj->setYear("2018");
        $proj->setWomen("1.5");
        $proj->setMen("10.8");
        $toArray = [$proj];

        // Now, mock the repository so it returns the mock of the employee
        $projRepository = $this->createMock(Report5Repository::class);

        $projRepository->expects($this->any())
            ->method('find')
            ->willReturn($proj);
        $chart1 = new Chart5($toArray);

        $this->assertInstanceOf(Chart5::class, $chart1);
        $this->assertIsArray($chart1->getYear());
        $this->assertIsArray($chart1->getWomen());
        $this->assertIsArray($chart1->getMen());
    }
};
