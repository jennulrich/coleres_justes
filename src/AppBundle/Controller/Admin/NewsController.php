<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\News;
use AppBundle\Manager\NewsManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /** @var NewsManager */
    private $newsManager;

    public function __construct(NewsManager $newsManager)
    {
        $this->newsManager = $newsManager;
    }

    /**
     * @Route("admin/news/{id}", name="admin_news_view", requirements={"id"="\d+"})
     * @param $id int
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        $new = $this->newsManager->get($id);

        return $this->render('admin/news/news-detail.html.twig', [
            "new" => $new
        ]);
    }

    /**
     * @Route("admin/news", name="admin_news")
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $news = $this->newsManager->getList();

        //$total = $this->newsManager->getTotal();

        /** @var $paginator Paginator*/
        $paginator = $this->get('knp_paginator');
        $paginator->setDefaultPaginatorOptions(array(
                'align' => 'center'
            ));

        $result = $paginator->paginate(
            $news,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );


        return $this->render('admin/news/news.html.twig', [
            "news" => $result,
            //"total" => $total
        ]);
    }

    /**
     * @Route("/admin/news/add", name="add_news")
     * @return Response
     * @param Request $request
     */
    public function addAction(Request $request): Response
    {
        $news = new News();

        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->newsManager->save($news);

            return $this->redirectToRoute('admin_news');
        }

        return$this->render('admin/news/add-news.html.twig', [
            'form' => $form->createView(),
            'news' => $news
        ]);
    }

    /**
     * @Route("/news/{id}/edit", name="news_edit", requirements={"id"="\d+"})
     */
    public function editAction(int $id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $new = $em->getRepository(News::class)
            ->find($id);
        //$news->setImage(null);
        $form = $this->createForm(NewsType::class, $new);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $new = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();
            return $this->redirectToRoute('admin_news_view', [
                "id"=>$new->getId(),
            ]);
        }

        return $this->render('admin/news/edit-news.html.twig', [
            'form' => $form->createView(),
            'new' => $new
        ]);
    }

    /**
     * @Route("/admin/news/{id}/delete", name="delete_news", requirements={"id"="\d+"})
     * @return Response
     */
    public function DeleteAction(News $news): Response
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('admin_news');
    }

    /**
     * @Route("/admin/news/{id}/image", name="news_image", requirements={"id"="\d+"})
     */
    public function ImageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)
            ->find($id);
        $file = $this->getParameter("images_directory")."/".$news->getImage();
        return new BinaryFileResponse($file);
    }
}
