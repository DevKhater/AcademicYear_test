<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AcademicCommand extends ContainerAwareCommand
{

    protected function configure()
    {

        $this
                ->setName('academic:search')
                ->setDescription('search from yaml datasource by date')
                ->addArgument(
                        'year', InputArgument::REQUIRED, 'select year '
                )
                ->addArgument(
                        'file', InputArgument::REQUIRED, 'select yml file '
                )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = $input->getArgument('year');
        $file = $input->getArgument('file');
        $Data = $this->getApplication()->getKernel()->getContainer()->get('academic_manager');
        $Data->load($file);
        $academic = $Data->getByDate(strtotime($date));
        if (is_null($academic)) {
            $output->writeln("    >>  No Recorded Academic Year is Found in this Date. ");
        } else {
            $output->writeln("  >  Date belongs to academic year <info>" . $academic->getName() . "</info>");
            $output->writeln("  >  Academic year contains the following terms: ");
            foreach ($academic->getTerms() as $term) {
                $output->writeln("    >>  " . $term->getName() . ' ' . $academic->getName() . ' ' . '(' . $term->getTermDuration() . " days)");
            }
        }
    }

}
