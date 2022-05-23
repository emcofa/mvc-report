<?php

namespace App\Project;

use App\Entity\Report3;
use PHPUnit\Framework\TestCase;
use App\Repository\Report3Repository;



/**
 * Test cases for class Chart3.
 */
class Chart3Test extends TestCase
{
    /**
     * Test to Chart 3 see if correct instance returns with correct datasets
     */
    public function testChart5()
    {

        $proj = new Report3();
        $proj->setYear("2018");
        $proj->setAge1("9");
        $toArray = [$proj];

        // Now, mock the repository so it returns the mock of the employee
        $projRepository = $this->createMock(Report3Repository::class);

        $projRepository->expects($this->any())
            ->method('find')
            ->willReturn($proj);
        $chart1 = new Chart3($toArray);

        $this->assertInstanceOf(Chart3::class, $chart1);
        $this->assertIsArray($chart1->getYear());
        $this->assertIsArray($chart1->getAge1());
    }
};
