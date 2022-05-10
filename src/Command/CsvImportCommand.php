<?php

namespace App\Command;

use App\Entity\Project;
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
