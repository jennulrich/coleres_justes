<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Manager\NewsManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    /**
     * @Route("admin/dashboard", name="dashboard")
     */
    public function listAction(NewsManager $newsManager)
    {
        $news = $newsManager->getList();

        return $this->render('admin/dashboard/dashboard.html.twig', [
            "news" => $news
        ]);
    }
}
