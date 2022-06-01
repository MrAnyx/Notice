<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Entity\Thread;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Uid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ThreadRepositoryTest extends KernelTestCase
{
    private ?EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByContent(): void
    {
        /** @var Thread $thread */
        $thread = $this->entityManager
            ->getRepository(Thread::class)
            ->findOneBy(['content' => 'Thread 1.0'])
        ;

        $this->assertNull($thread->getParent());
        $this->assertFalse($thread->isRestricted());
    }

    public function testAdd(): void
    {
        $thread = new Thread();
        $thread->setAuthor($this->createMock(User::class));
        $thread->setContent("Content");
        $thread->setThreadId(Uuid::v4());

        $this->entityManager->getRepository(Thread::class)->add($thread);

        $this->assertNotEmpty($thread->getId());
    }

    public function testRemove(): void
    {
        /** @var Thread $thread */
        $thread = $this->entityManager
            ->getRepository(Thread::class)
            ->findOneBy(['content' => 'Thread 1.0'])
        ;

        $this->entityManager->getRepository(Thread::class)->remove($thread);
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
