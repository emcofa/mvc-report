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
use SebastianBergmann\Environment\Console;

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
 * @package App\ConsoleCommand
 */
class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $em
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }
    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports the mock CSV data file');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting import of Feed...');
        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Csv/report1.csv');
        $reader->setHeaderOffset(0);
    
        $reader2 = Reader::createFromPath('%kernel.root_dir%/../src/Csv/report2-5.2.1.csv');
        $reader2->setHeaderOffset(0);
    
        $reader3 = Reader::createFromPath('%kernel.root_dir%/../src/Csv/report3-5.a.3(n).csv');
        $reader3->setHeaderOffset(0);

        $reader4 = Reader::createFromPath('%kernel.root_dir%/../src/Csv/report4-5.4.1.csv');
        $reader4->setHeaderOffset(0);

        $reader5 = Reader::createFromPath('%kernel.root_dir%/../src/Csv/report5-5.2.2.csv');
        $reader5->setHeaderOffset(0);

        foreach ($reader2->setHeaderOffset(0) as $row) {
            $result = (new Report2())
                ->setArea($row['Area'])
                ->setType($row['Type'])
                ->setYear1($row['2018'])
                ->setYear2($row['2019']);

            $this->em->persist($result);
        }

        foreach ($reader3->setHeaderOffset(0) as $row) {
            $result = (new Report3())
                ->setYear($row['År'])
                ->setAge1($row['20 år och äldre'])
                ->setAge2($row['20–64 år'])
                ->setAge3($row['65 år och äldre'])
                ->setBorn1($row['Inrikesfödda'])
                ->setBorn2($row['Utrikesfödda']);

            $this->em->persist($result);
        }

        foreach ($reader4->setHeaderOffset(0) as $row) {
            $result = (new Report4())
                ->setYear($row['År'])
                ->setGender($row['Kön'])
                ->setAge1($row['15-84 (20-84) år*'])
                ->setAge2($row['15-24 (20-24) år*'])
                ->setAge3($row['25-44 år'])
                ->setAge4($row['45-54 år'])
                ->setAge5($row['55-64 år'])
                ->setAge6($row['65+ år']);

            $this->em->persist($result);
        }

        foreach ($reader5->setHeaderOffset(0) as $row) {
            $result = (new Report5())
                ->setYear($row['År'])
                ->setWomen($row['Kvinnor'])
                ->setMen($row['Män']);

            $this->em->persist($result);
        }

        foreach ($reader->setHeaderOffset(0) as $row) {
            $result = (new Project())
                ->setYear($row['Year'])
                ->setWomen($row['Women'])
                ->setMen($row['Men']);

            $this->em->persist($result);
        }

        $this->em->flush();

        $io->success('Command exited cleanly!');
    }
}
