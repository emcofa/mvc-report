<?php

namespace App\Project;

/**
 * Class Chart3
 * @package App\Project;
 * @author Emmie Fahlström
 */
class Chart3
{
    /**
     * @var array<string> get the year of data
     */
    private $year = [];

    /**
     * @var array<string> Data of Age 1 in table
     */
    private $age1 = [];

    /**
     * @param array<object> $data all the data into array
     */
    public function __construct(array $data)
    {
        foreach ($data as $line) {
            $this->year[] = $line->getYear();
            $this->age1[] = $line->getAge1();
        }
    }

    /**
     * @param object $chart The data of the chart which will displayed in template
     * @return void
     */
    public function setChart($chart):void
    {
        $chart->setData([
            'labels' => $this->year,
            'datasets' => [
                [
                    'label' => "Kvinnors nettoinkomst, 20 år och äldre (%)",
                    'data' => $this->age1,
                    'fill' => false,
                    'borderColor' => '#D56650',
                    'tension' => 0.1,
                    'backgroundColor' => '#D56650',
                ],
            ],
        ]);
    }

    /**
     * Get the data of year
     * @return array<string>
     */
    public function getYear(): array
    {
        return $this->year;
    }

    /**
     * Get the data of Age 1
     * @return array<string>
     */
    public function getAge1(): array
    {
        return $this->age1;
    }
}
