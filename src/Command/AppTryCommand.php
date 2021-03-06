<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;


class AppTryCommand extends Command
{
    protected static $defaultName = 'app:try';

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->seDescrition('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        # Create
        $link = new \App\Entity\LinkEntity();
        $link
            ->setUrl('https://www.emagma.fr/')
            ->setLabel('Emagma')
            ->setDescrition('Agence d\'experts en e-commerce et développement web innovant')
            ->setIsread(True)
            ->setRating(2);

        try {
            $this->entityManager->persist($link);
            $this->entityManager->flush();

            $io->success('Link created');
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());
        }
    }
}
