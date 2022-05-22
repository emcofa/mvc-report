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
     * @var array get the year of data
     */
    private $year = [];

    /**
     * @var array Data of men 2016
     */
    private $age1 = [];

    /**
     * @var array Data of age1 2017
     */
    private $men = [];

    /**
     * @param array $sort all the data into array
     */
    public function __construct(array $data)
    {
        foreach ($data as $line) {
            $this->year[] = (string) $line->getYear();
            $this->age1[] = (string) $line->getAge1();
        }
    }

    /**
     * @param object $chart The chart that the data will be connected with
     *
     * This function set the data to the chart created in the controller
     */
    public function setChart($chart)
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
}
