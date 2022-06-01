<?php

namespace App\DataFixtures;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Generator;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;
use App\Entity\Thread;

/**
 * @codeCoverageIgnore
 */
class TestFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setUsername("user1");
        $user1->setEmail("user1@mail.com");
        $password1 = $this->hasher->hashPassword($user1, 'password');
        $user1->setPassword($password1);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("user2");
        $user2->setEmail("user2@mail.com");
        $password1 = $this->hasher->hashPassword($user2, 'password');
        $user2->setPassword($password1);
        $manager->persist($user2);

        $manager->flush();

        $threadId1 = Uuid::v4();

        $thread10 = new Thread();
        $thread10->setAuthor($user1);
        $thread10->setContent("Thread 1.0");
        $thread10->setThreadId($threadId1);

        $thread11 = new Thread();
        $thread11->setAuthor($user1);
        $thread11->setContent("Thread 1.1");
        $thread11->setThreadId($threadId1);
        $thread11->setParent($thread10);

        $thread12 = new Thread();
        $thread12->setAuthor($user1);
        $thread12->setContent("Thread 1.2");
        $thread12->setThreadId($threadId1);
        $thread12->setParent($thread11);

        $threadId2 = Uuid::v4();

        $thread20 = new Thread();
        $thread20->setAuthor($user2);
        $thread20->setContent("Thread 2.0");
        $thread20->setThreadId($threadId2);

        $thread21 = new Thread();
        $thread21->setAuthor($user2);
        $thread21->setContent("Thread 2.1");
        $thread21->setThreadId($threadId2);
        $thread21->setParent($thread20);

        $thread30 = new Thread();
        $thread30->setAuthor($user1);
        $thread30->setContent("Thread 3.0");
        $thread30->setThreadId(Uuid::v4());

        $manager->persist($thread10);
        $manager->persist($thread11);
        $manager->persist($thread12);
        $manager->persist($thread20);
        $manager->persist($thread21);
        $manager->persist($thread30);

        $manager->flush();

        $comment10 = new Thread();
        $comment10->setAuthor($user1);
        $comment10->setContent("Comment 1.0");
        $comment10->setThreadId(Uuid::v4());
        $comment10->setParent($thread10);

        $comment10bis = new Thread();
        $comment10bis->setAuthor($user1);
        $comment10bis->setContent("Comment 1.0 bis");
        $comment10bis->setThreadId(Uuid::v4());
        $comment10bis->setParent($thread10);

        $comment11 = new Thread();
        $comment11->setAuthor($user2);
        $comment11->setContent("Comment 1.1");
        $comment11->setThreadId(Uuid::v4());
        $comment11->setParent($thread11);

        $comment21 = new Thread();
        $comment21->setAuthor($user2);
        $comment21->setContent("Comment 2.1");
        $comment21->setThreadId(Uuid::v4());
        $comment21->setParent($thread21);

        $manager->persist($comment10);
        $manager->persist($comment10bis);
        $manager->persist($comment11);
        $manager->persist($comment21);

        $manager->flush();

        $comment100 = new Thread();
        $comment100->setAuthor($user1);
        $comment100->setContent("Comment 1.0.0");
        $comment100->setThreadId(Uuid::v4());
        $comment100->setParent($comment10);

        $manager->persist($comment100);
        $manager->flush();
    }
}
