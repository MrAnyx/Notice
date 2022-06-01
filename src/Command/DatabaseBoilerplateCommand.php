<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'database:boilerplate',
    description: 'A short way to create and configure the databases for dev and test environments',
)]
class DatabaseBoilerplateCommand extends Command
{
    protected function configure(): void
    {
        $this->addOption('test', null, InputOption::VALUE_NONE, 'Specify the environment you want to use');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $isTestEnv = $input->getOption('test');

        $io->success(sprintf(
            "To configure your database for the %s environment, run the following commands :\n\n php bin/console doctrine:database:drop --force --env=%s --if-exists --no-interaction\n php bin/console cache:clear --env=%s\n php bin/console doctrine:cache:clear-metadata --env=%s --no-interaction\n php bin/console doctrine:database:create --if-not-exists --env=%s --no-interaction\n php bin/console doctrine:schema:drop --force --env=%s --no-interaction\n php bin/console doctrine:migrations:migrate --env=%s --no-interaction\n php bin/console doctrine:schema:validate --env=%s --no-interaction\n php bin/console doctrine:fixtures:load --env=%s --group=%s --no-interaction",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "test" : "dev",
            $isTestEnv ? "TestFixtures" : "AppFixtures"
        ));

        return Command::SUCCESS;
    }
}
