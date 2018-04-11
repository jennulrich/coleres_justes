<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user
            ->setPassword('$2y$10$LlPMShQH0oM1pYY1UvRCDuVI8Rin8bMhHoSgXinF48dqSsKdJ5LAa')
            ->setLastName('Admin')
            ->setFirstName('Jenn')
            ->setIsAdmin('1')
            ->setRegisteredAt(new \DateTime('2017-12-09'))
            ->setEmail('admin@test.fr')
            // password : bcrypt('password')
            ->setPassword( '$2y$10$LlPMShQH0oM1pYY1UvRCDuVI8Rin8bMhHoSgXinF48dqSsKdJ5LAa');

        $manager->persist($user);
        $manager->flush();
    }
}