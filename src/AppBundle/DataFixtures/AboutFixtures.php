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
            ->setContent('
               
                            Cyril Delvart débute sa carrière dans le long métrage auprès de réalisateurs comme Mathieu Kassovitz ou
                            Bernie Bonvoisin.
                       
                            Par la suite, il se lance dans la réalisation de courts métrages, qui seront tous primés dans différents pays,
                            et son film « Dans la Lune » est récompensé par la Fondation Beaumarchais.
                        
                            Il découvre la publicité par le biais de la post production.
                            
                            Au bout de quelques années passées auprès des agences,
                            
                            naturellement celles-ci lui confient la réalisation de films.
                        
                            Dans le même temps, Cyril continu de développer ses projets de longs métrages.
                            
                            Son expérience de la fiction, le pousse naturellement vers les projets scénarisés, porteurs de sens.
                            
                            C\'est pourquoi, même à travers ses réalisations publicitaires, il garde à l\'esprit que ce qui justifie
                            unfilm, au-delà des considérations esthétiques, c\'est avant tout le propos.
                        
                            Aujourd\'hui, il présente sa première série photographique intitulée "Les colères justes" dans laquelle
                            il met en scène des personnes engagées, qui par leur refus d\'abdiquer se sont mis un jour en colère.
                        
            ');

        $manager->persist($aboutContent);
        $manager->flush();
    }
}