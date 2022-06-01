<?php

namespace App\Tests\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DatabaseBoilerplateCommandTest extends KernelTestCase
{
    public function testCommandDevEnv(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('database:boilerplate');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();
    }

    public function testCommandTestEnv(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('database:boilerplate');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            "--test" => true
        ]);

        $commandTester->assertCommandIsSuccessful();
    }
}
