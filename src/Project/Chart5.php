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
     * @var array<string> get the year of data
     */
    private $year = [];

    /**
     * @var array<string> Data of men 2016
     */
    private $women = [];

    /**
     * @var array<string> Data of women 2017
     */
    private $men = [];

    /**
     * @param array<object> $data sort all the data into array
     */
    public function __construct(array $data)
    {
        foreach ($data as $line) {
            $this->year[] = $line->getYear();
            $this->women[] = $line->getWomen();
            $this->men[] = $line->getMen();
        }
    }

    /**
     * @param object $chart The data of the chart which will displayed in template
     * @return void
     */
    public function setChart($chart): void
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
     * Get the data of year
     * @return array<string>
     */
    public function getYear(): array
    {
        return $this->year;
    }

    /**
     * Get the data of women
     * @return array<string>
     */
    public function getWomen(): array
    {
        return $this->women;
    }

    /**
     * Get the data of men
     * @return array<string>
     */
    public function getMen(): array
    {
        return $this->men;
    }
}
