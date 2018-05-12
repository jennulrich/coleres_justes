<?php

namespace AppBundle\Controller;

use AppBundle\Entity\About;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $abouts = $em->getRepository(About::class)
            ->findAll();
        return $this->render('front/about/about.html.twig', [
            "abouts" => $abouts
        ]);
    }
}