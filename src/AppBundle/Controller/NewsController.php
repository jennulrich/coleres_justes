<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use AppBundle\Entity\News;
use AppBundle\Form\AboutType;
use AppBundle\Form\NewsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends Controller
{
    /**
     * @Route("/news/{id}", name="news_view", requirements={"id"="\d+"})
     * @param $id int
     * @return $new
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $new = $em->getRepository(News::class)
            ->find($id);
        return $this->render('front/news/news-detail.html.twig', [
            "new" => $new
        ]);
    }

    /**
     * @Route("/news", name="news")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)
            ->findAll();
        return $this->render('front/news/news.html.twig', [
            "news" => $news
        ]);
    }
}
