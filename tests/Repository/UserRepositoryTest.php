<?php

namespace App\Tests\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchUsername(): void
    {
        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => 'user1'])
        ;

        $this->assertSame("user1@mail.com", $user->getEmail());
        $this->assertIsArray($user->getRoles());
        $this->assertSame("ROLE_USER", $user->getRoles()[0]);
    }

    public function testAdd(): void
    {
        $user = new User();
        $user->setUsername("username")
            ->setEmail("username@mail.com")
            ->setPassword("password");

        $this->entityManager->getRepository(User::class)->add($user);

        $this->assertNotEmpty($user->getId());
    }

    public function testRemove(): void
    {
        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => 'user1'])
        ;

        $this->entityManager->getRepository(User::class)->remove($user);
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
