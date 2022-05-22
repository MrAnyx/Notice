<?php

namespace App\Tests\Service;

use App\Service\AppVersionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class AppVersionServiceTest extends KernelTestCase
{
    public function testAppVersion()
    {
        self::bootKernel();

        $container = static::getContainer();

        $service = $container->get(AppVersionService::class);
        $kernel = $container->get(KernelInterface::class);
        $appVersion = $service->currentVersion();

        $this->assertEquals($appVersion, file_get_contents($kernel->getProjectDir().'/VERSION'));
    }
}
