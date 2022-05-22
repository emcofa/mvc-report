<?php

namespace App\Project;

/**
 * Class Chart1
 * @package App\Project;
 * @author Emmie Fahlström
 */
class Chart1
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
            $this->year[] = (float) $line->getYear();
            $this->women[] = (float) $line->getWomen();
            $this->men[] = (float) $line->getMen();
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
                    'label' => "2016",
                    'backgroundColor' => [
                        '#abebc6',
                        '#abebc6',
                    ],
                    'data' => [$this->women[0], $this->men[0]],
                    'fill' => false,
                    'borderColor' => 'black',
                    'tension' => 0.1,

                ],
                [
                    'label' => "2017",
                    'backgroundColor' => [
                        '#1e8449',
                        '#1e8449',
                    ],
                    'data' => [$this->women[1], $this->men[1]],
                    'fill' => false,
                    'borderColor' => 'black',
                    'tension' => 0.1,
                ],
            ],
        ]);
    }

    /**
     * Set the title from the data
     */
    public function setHeadlines(): void
    {
        $this->headline = "Andel (%) av befolkningen 16-84 år för kvinnor respektive män";
    }

    /**
     * Get the title from the data
     */
    public function getHeadlines(): string
    {
        return $this->headline;
    }
}
