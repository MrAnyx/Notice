<?php

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Thread;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ThreadTest extends KernelTestCase
{
    private Thread $thread;

    protected function setUp(): void
    {
        $threadId = Uuid::fromString('00000000-0000-0000-0000-000000000000');
        $this->thread = new Thread();
        $this->thread->setContent("Content")
            ->setThreadId($threadId)
            ->setAuthor($this->createMock(User::class));
    }

    public function testContent(): void
    {
        $this->assertSame("Content", $this->thread->getContent());
    }

    public function testAuthor(): void
    {
        $this->assertTrue($this->thread->getAuthor() instanceof User);
    }

    public function testCreatedAt(): void
    {
        $this->assertTrue($this->thread->getCreatedAt() instanceof DateTimeImmutable);
    }

    public function testThreadId(): void
    {
        $this->assertTrue($this->thread->getThreadId() instanceof Uuid);
        $this->assertSame('00000000-0000-0000-0000-000000000000', $this->thread->getThreadId()->toRfc4122());
    }

    public function testParent(): void
    {
        $this->assertNull($this->thread->getParent());
    }

    public function testChildren(): void
    {
        $this->assertEquals(0, count($this->thread->getChildren()));
    }

    public function testRestricted(): void
    {
        $this->assertFalse($this->thread->isRestricted());
    }
}
