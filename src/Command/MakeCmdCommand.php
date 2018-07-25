<?php
namespace ArtisanTrain\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCmdCommand extends Command
{

    protected function configure()
    {

        $this->setName("make:command")
            ->setDescription("Creates new command.")
            ->setHelp("This command allows you to create new command file.");

        $this->addArgument('CmdName', InputArgument::REQUIRED, 'The name of the command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            array(
                'Command Creator',
                'Command Name: ' . $input->getArgument('CmdName'),
                '==========',
            )
        );

        

        $output->writeln('Successfully created command file.');
    }
}
