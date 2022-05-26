<?php

namespace App\Tests\Service;

use App\Entity\Animal;
use App\Service\AppVersionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

class AppVersionServiceTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

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

    public function testSearchByName()
    {
        $dog = $this->em
            ->getRepository(Animal::class)
            ->findOneBy(['name' => 'Dog'])
        ;

        $this->assertSame('France', $dog->getLocation());
    }
}
