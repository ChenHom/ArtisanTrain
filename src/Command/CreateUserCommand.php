<?php
namespace ArtisanTrain\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{

    protected function configure()
    {

        $this->setName("make:create-user")
            ->setDescription("Creates new users.")
            ->setHelp("This command allows you to create users.");

        $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(array('User Creator', '==========', ''));
        $output->writeln('Whoa!');
        $output->writeln('username: ' . $input->getArgument('username'));
    }
}
