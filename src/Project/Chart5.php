<?php

namespace App\Project;


/**
 * Class Chart5
 * @package App\Project;
 * @author Emmie Fahlström
 */
class Chart5
{
    /**
     * @var string The headline
     */
    private $headline = "";

    /**
     * @var array get the year of data
     */
    private $year = [];

    /**
     * @var array Data of men 2016
     */
    private $women = [];

    /**
     * @var array Data of women 2017
     */
    private $men = [];

    /**
     * @param array $sort all the data into array
     */
    public function __construct(array $data)
    {
        foreach ($data as $line) {
            $this->year[] = (string) $line->getYear();
            $this->women[] = (string) $line->getWomen();
            $this->men[] = (string) $line->getMen();
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
            'labels' => [
                'Kvinnor',
                'Män',
            ],
            'datasets' => [
                [
                    'label' => 'statistik 2017',
                    'backgroundColor' => [
                        '#D56650',
                        '#3498db',
                    ],
                    'data' => [$this->women[1], $this->men[1]],
                ],
            ],
        ]);
    }

    /**
     * Set the title from the data
     */
    public function setHeadlines(): void
    {
        $this->headline = $this->year[1];
    }

    /**
     * Get the title from the data
     */
    public function getHeadlines(): string
    {
        return $this->headline;
    }
}
