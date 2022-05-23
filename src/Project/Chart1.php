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
     * @var array data of women
     */
    private $women = [];

    /**
     * @var array data of men
     */
    private $men = [];

    /**
     * @param array $data sort all the data into array
     */
    public function __construct(array $data)
    {
        var_dump($data);
        foreach ($data as $line) {
            $this->year[] = (string) $line->getYear();
            $this->women[] = (float) $line->getWomen();
            $this->men[] = (float) $line->getMen();
        }
    }

    /**
     * @param object $chart The data of the chart which will displayed in template
     *
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
    public function setHeadlines(string $headline): void
    {
        $this->headline = $headline;
    }


    /**
     * Get the title from the data
     */
    public function getHeadlines(): string
    {
        return $this->headline;
    }

    /**
     * Get the data of year
     */
    public function getYear(): array
    {
        return $this->year;
    }

    /**
     * Get the data of women
     */
    public function getWomen(): array
    {
        return $this->women;
    }

    /**
     * Get the data of men
     */
    public function getMen(): array
    {
        return $this->men;
    }
}
