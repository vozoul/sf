<?php

namespace App\DataFixtures;

use App\Entity\Duck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DuckFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $duck = new Duck();
        $duck->setFirstname('demo');
        $duck->setLastname('demo');
        $duck->setDuckname('demo');
        $duck->setEmail('demo@demo.fr');
        $duck->setPassword($this->encoder->encodePassword($duck, 'demo'));
        $manager->persist($duck);

        $manager->flush();
    }
}
