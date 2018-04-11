<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $news = [
            [
                "title" => "News 1",
                "content" => "Content news 1",
                "published_at" => "2017-11-23",
                "inserted_at" => "2018-11-23"
            ],
            [
                "title" => "News 2",
                "content" => "Content news 2",
                "published_at" => "2017-11-23",
                "inserted_at" => "2018-11-23"
            ],
            [
                "title" => "News 3",
                "content" => "Content news 3",
                "published_at" => "2017-11-23",
                "inserted_at" => "2018-11-23"
            ],
            [
                "title" => "News 4",
                "content" => "Content news 4",
                "published_at" => "2017-11-23",
                "inserted_at" => "2018-11-23"
            ]
        ];

        foreach ($news as $new){
            $newDetail = new News();
            $newDetail
                ->setTitle($new['title'])
                ->setContent($new['content'])
                ->setPublishedAt(new \DateTime($new['published_at']))
                ->setInsertedAt(new \DateTime($new['inserted_at']));

            $manager->persist($newDetail);
        }
        $manager->flush();
    }
}