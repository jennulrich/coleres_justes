<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\News;
use AppBundle\Manager\NewsManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\NewsType;
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
    public function listAction(): Response
    {
        $news = $this->newsManager->getList();

        return $this->render('admin/news/news.html.twig', [
            "news" => $news
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
}
