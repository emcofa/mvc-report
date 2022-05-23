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
     * @var array<string> get the year of data
     */
    private $year = [];

    /**
     * @var array<float> data of women
     */
    private $women = [];

    /**
     * @var array<float> data of men
     */
    private $men = [];

    /**
     * @param array<object> $data sort all the data into array
     */
    public function __construct(array $data)
    {
        foreach ((array) $data as $line) {
            $this->year[] = $line->getYear();
            $this->women[] = $line->getWomen();
            $this->men[] = $line->getMen();
        }
    }

    /**
     * @param object $chart The data of the chart which will displayed in template
     * @return void
     *
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
     * Get the data of year
     * @return array<string>
     */
    public function getYear(): array
    {
        return $this->year;
    }

    /**
     * Get the data of women
     * @return array<float>
     */
    public function getWomen(): array
    {
        return $this->women;
    }

    /**
     * Get the data of men
     * @return array<float>
     */
    public function getMen(): array
    {
        return $this->men;
    }
}
