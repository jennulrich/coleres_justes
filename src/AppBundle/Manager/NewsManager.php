<?php

namespace AppBundle\Manager;

use AppBundle\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Repository\NewsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsManager
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var NewsRepository */
    private $newsRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->newsRepository = $this->entityManager->getRepository(News::class);
    }

    public function getList(): array
    {
        return $this->newsRepository->findAll();
    }

    public function get(int $id): News
    {
        /** @var $news News*/
        $news = $this->newsRepository->find($id);
        $this->checkNews($news);

        return $news;
    }

    public function save(News $news)
    {
        $this->entityManager->persist($news);
        $this->entityManager->flush();
    }

    public function remove(?News $news)
    {
        if(!$news) {
            return;
        }

        $this->entityManager->remove($news);
        $this->entityManager->flush();
    }

    private function checkNews(?News $news) {
        if (!$news) {
            throw new NotFoundHttpException('News Not Found.');
        }
    }
}
