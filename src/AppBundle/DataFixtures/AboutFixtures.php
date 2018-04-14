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
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse 
                            lacinia ac nulla sit amet ullamcorper. Aenean quis quam massa. 
                            Ut posuere volutpat semper. Proin ac gravida magna, sed fringilla turpis. D
                            onec euismod, dui id tincidunt imperdiet, libero tellus iaculis magna, id 
                            pharetra orci enim vel nulla. Fusce dignissim venenatis felis id tristique. 
                            Quisque ultrices eu nisi eu blandit. Nulla velit mi, aliquam vel suscipit nec, 
                            laoreet vulputate risus.

                          Curabitur tristique ultrices vehicula. Donec id orci sagittis, scelerisque 
                          tellus ac, congue orci. Morbi ac tortor risus. Nullam in nulla nec libero 
                          gravida ultricies sed ac tellus. Quisque vestibulum non mauris vitae posuere. 
                          Aenean ut ultricies nisi. Mauris sed dolor sagittis leo sollicitudin 
                          lobortis.');

        $manager->persist($aboutContent);
        $manager->flush();
    }
}