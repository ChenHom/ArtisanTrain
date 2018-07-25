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

        $this->setName("make:route")
            ->setDescription("Creates new channel route.")
            ->setHelp("This command allows you to create new channel route.");

        $this->addArgument('channelname', InputArgument::REQUIRED, 'The name of the channel.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            array(
                'Channel Route Creator',
                '==========',
            )
        );

        $output->writeln('Successfully created command file.');
    }
}
