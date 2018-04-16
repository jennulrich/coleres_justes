<?php

namespace AppBundle\DataFixtures;


use AppBundle\Entity\About;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AboutFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $aboutContent = new About();
        $aboutContent
            ->setImage(null)
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In euismod massa quis lacus gravida interdum. Fusce luctus, neque non fringilla scelerisque, odio leo efficitur tortor, vel venenatis felis elit varius felis. Integer ut sodales ante, et vestibulum massa. Nunc ac mattis nibh, sed porta odio. Proin aliquam nulla nec justo cursus, ut consequat nisi luctus. Mauris ultricies sapien sagittis, euismod enim id, iaculis massa. Cras auctor lorem erat. Suspendisse et consequat ligula. Cras laoreet augue purus, at semper purus fringilla ut. Quisque scelerisque diam vitae ante interdum pellentesque. In quis justo mi.');

        $manager->persist($aboutContent);
        $manager->flush();
    }
}