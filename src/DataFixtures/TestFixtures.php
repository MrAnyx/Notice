<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lion = new Animal();
        $lion->setName('Lion')
            ->setLocation('Afrique');

        $dog = new Animal();
        $dog->setName('Dog')
            ->setLocation('France');
        $manager->persist($lion);
        $manager->persist($dog);

        $manager->flush();
    }
}
