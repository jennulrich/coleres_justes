<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\NewsType;

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

    /**
     * @Route("/admin/news/add", name="add_news")
     */
    public function addAction(Request $request)
    {
        $news = new News();

        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('admin_news');
        }

        return$this->render('admin/news/add-news.html.twig', [
            'form' => $form->createView(),
            'news' => $news
        ]);
    }

    /**
     * @Route("/admin/news/{id}/delete", name="delete_news", requirements={"id"="\d+"})
     */
    public function DeleteAction(News $news)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('admin_news');
    }
}