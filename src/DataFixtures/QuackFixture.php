<?php

namespace App\DataFixtures;

use App\Entity\Quack;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class QuackFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for($i = 0; $i < 100; $i++){

         $quack = new Quack();
         $quack
             ->setTitle($faker->words(3, true))
             ->setContent($faker->sentences(3, true))
             ->setCreateAt($faker->dateTime());

         $manager->persist($quack);

        }

        $manager->flush();
    }
}
