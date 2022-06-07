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
class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create();
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setUsername($this->faker->userName());
            $user->setEmail($this->faker->email());
            $user->setToken(Uuid::v4()->toRfc4122());

            $password = $this->hasher->hashPassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);
            $users[] = $user;
        }

        $manager->flush();

        $threadId1 = Uuid::v4();

        $thread10 = new Thread();
        $thread10->setAuthor($users[0]);
        $thread10->setContent("Thread 1.0 : Hello World!");
        $thread10->setThreadId($threadId1);

        $thread11 = new Thread();
        $thread11->setAuthor($users[0]);
        $thread11->setContent("Thread 1.1 : Omegle in the sauce!");
        $thread11->setThreadId($threadId1);
        $thread11->setParent($thread10);

        $thread12 = new Thread();
        $thread12->setAuthor($users[0]);
        $thread12->setContent("Thread 1.2 : Twitter buyout by Elon Musk");
        $thread12->setThreadId($threadId1);
        $thread12->setParent($thread11);

        $threadId2 = Uuid::v4();

        $thread20 = new Thread();
        $thread20->setAuthor($users[1]);
        $thread20->setContent("Thread 2.0 : League of legends is fun lol");
        $thread20->setThreadId($threadId2);

        $thread21 = new Thread();
        $thread21->setAuthor($users[1]);
        $thread21->setContent("Thread 2.1 : Jungle is the best role");
        $thread21->setThreadId($threadId2);
        $thread21->setParent($thread20);

        $thread30 = new Thread();
        $thread30->setAuthor($users[2]);
        $thread30->setContent("Thread 3.0 : ADC, what a wonderful place to play");
        $thread30->setThreadId(Uuid::v4());

        $manager->persist($thread10);
        $manager->persist($thread11);
        $manager->persist($thread12);
        $manager->persist($thread20);
        $manager->persist($thread21);
        $manager->persist($thread30);

        $manager->flush();

        $comment10 = new Thread();
        $comment10->setAuthor($users[4]);
        $comment10->setContent("Comment 1.0 : Let's start coding");
        $comment10->setThreadId(Uuid::v4());
        $comment10->setParent($thread10);

        $comment10bis = new Thread();
        $comment10bis->setAuthor($users[4]);
        $comment10bis->setContent("Comment 1.0 : How are you doing?");
        $comment10bis->setThreadId(Uuid::v4());
        $comment10bis->setParent($thread10);

        $comment11 = new Thread();
        $comment11->setAuthor($users[3]);
        $comment11->setContent("Comment 1.1 : Don't worry, be happy");
        $comment11->setThreadId(Uuid::v4());
        $comment11->setParent($thread11);

        $comment21 = new Thread();
        $comment21->setAuthor($users[1]);
        $comment21->setContent("Comment 2.1 : Yeah but it's quite hard to play");
        $comment21->setThreadId(Uuid::v4());
        $comment21->setParent($thread21);

        $manager->persist($comment10);
        $manager->persist($comment10bis);
        $manager->persist($comment11);
        $manager->persist($comment21);

        $manager->flush();

        $comment100 = new Thread();
        $comment100->setAuthor($users[2]);
        $comment100->setContent("Comment 1.0.0 : This is comment of comment");
        $comment100->setThreadId(Uuid::v4());
        $comment100->setParent($comment10);

        $manager->persist($comment100);
        $manager->flush();

        $users[0]->addLike($thread10);
        $users[0]->addLike($thread11);
        $users[0]->addLike($thread12);
        $users[1]->addLike($thread20);
        $users[2]->addLike($comment10);
        $users[2]->addLike($comment11);
        $users[2]->addLike($comment10bis);
        $users[3]->addLike($comment100);

        $manager->persist($users[0]);
        $manager->persist($users[1]);
        $manager->persist($users[2]);
        $manager->persist($users[3]);
        $manager->flush();
    }
}
