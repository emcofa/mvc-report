<?php

namespace App\Command;

use App\Entity\Project;
use App\Entity\Report2;
use App\Entity\Report3;
use App\Entity\Report4;
use App\Entity\Report5;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use League\Csv\Reader;
use Doctrine\ORM\EntityManagerInterface;

// the "name" and "description" arguments of AsCommand replace the
// static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'csv:import',
    description: 'Imports the mock CSV data file',
    hidden: false,
    aliases: ['csv:import']
)]

/**
 * Class CsvImportCommand
 * @package App\Command
 */
class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $emi;

    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $emi
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(EntityManagerInterface $emi)
    {
        parent::__construct();

        $this->emi = $emi;
    }
    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports the mock CSV data file');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // add %kernel.root_dir% in front of "../src/Csv/" if you want to execute csv:import command through terminal/
        $inputOutput = new SymfonyStyle($input, $output);
        $inputOutput->title('Attempting import of Feed...');
        $reader = Reader::createFromPath('../src/Csv/report1.csv');
        $reader->setHeaderOffset(0);

        $reader2 = Reader::createFromPath('../src/Csv/report2-5.2.1.csv');
        $reader2->setHeaderOffset(0);

        $reader3 = Reader::createFromPath('../src/Csv/report3-5.a.3(n).csv');
        $reader3->setHeaderOffset(0);

        $reader4 = Reader::createFromPath('../src/Csv/report4-5.4.1.csv');
        $reader4->setHeaderOffset(0);

        $reader5 = Reader::createFromPath('../src/Csv/report5-5.2.2.csv');
        $reader5->setHeaderOffset(0);

        foreach ($reader2->setHeaderOffset(0) as $row) {
            $result = (new Report2())
                ->setArea(strval($row['Area']))
                ->setType(strval($row['Type']))
                ->setYear1(strval($row['2018']))
                ->setYear2(strval($row['2019']));

            $this->emi->persist($result);
        }

        foreach ($reader3->setHeaderOffset(0) as $row) {
            $result = (new Report3())
                ->setYear(strval($row['??r']))
                ->setAge1(strval($row['20 ??r och ??ldre']))
                ->setAge2(strval($row['20???64 ??r']))
                ->setAge3(strval($row['65 ??r och ??ldre']))
                ->setBorn1(strval($row['Inrikesf??dda']))
                ->setBorn2(strval($row['Utrikesf??dda']));

            $this->emi->persist($result);
        }

        foreach ($reader4->setHeaderOffset(0) as $row) {
            $result = (new Report4())
                ->setYear(strval($row['??r']))
                ->setGender(strval($row['K??n']))
                ->setAge1(strval($row['15-84 (20-84) ??r*']))
                ->setAge2(strval($row['15-24 (20-24) ??r*']))
                ->setAge3(strval($row['25-44 ??r']))
                ->setAge4(strval($row['45-54 ??r']))
                ->setAge5(strval($row['55-64 ??r']))
                ->setAge6(strval($row['65+ ??r']));

            $this->emi->persist($result);
        }

        foreach ($reader5->setHeaderOffset(0) as $row) {
            $result = (new Report5())
                ->setYear(strval($row['??r']))
                ->setWomen(strval($row['Kvinnor']))
                ->setMen(strval($row['M??n']));

            $this->emi->persist($result);
        }

        foreach ($reader->setHeaderOffset(0) as $row) {
            $result = (new Project())
                ->setYear(strval($row['Year']))
                ->setWomen(floatval($row['Women']))
                ->setMen(floatval($row['Men']));

            $this->emi->persist($result);
        }

        $this->emi->flush();

        $inputOutput->success('Command exited cleanly!');
        return 0;
    }
}
