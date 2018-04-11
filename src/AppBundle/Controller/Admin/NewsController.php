<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @Route("admin/news/{id}", name="admin_news_view", requirements={"id"="\d+"})
     * @param $id int
     * @return $new
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $new = $em->getRepository(News::class)
            ->find($id);
        return $this->render('admin/news/news-detail.html.twig', [
            "new" => $new
        ]);
    }

    /**
     * @Route("admin/news", name="admin_news")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)
            ->findAll();
        return $this->render('admin/news/news.html.twig', [
            "news" => $news
        ]);
    }
}