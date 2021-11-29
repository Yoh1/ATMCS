<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Usersfixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new Users();
        
        $user->setEmail("jean.michel.defaut@rien.org")
            ->setRoles(['USER'])
            ->setPassword('coucou')
            ->setIsVerified('1');

        $manager->persist($user);
        $this->addReference('jean.michel', $user);

        $manager->flush();
    }
}
