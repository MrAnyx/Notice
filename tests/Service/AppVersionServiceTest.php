<?php

namespace App\Tests\Service;

use App\Service\AppVersionService;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppVersionServiceTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManager $em;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testAppVersion()
    {
        $container = static::getContainer();

        $service = $container->get(AppVersionService::class);
        $kernel = $container->get(KernelInterface::class);
        $appVersion = $service->currentVersion();

        $this->assertEquals($appVersion, file_get_contents($kernel->getProjectDir() . '/VERSION'));
    }
}
