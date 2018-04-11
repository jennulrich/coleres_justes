<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GalleryController extends Controller
{
    /**
     * @Route("/galerie", name="gallery")
     */
    public function indexAction()
    {
        return $this->render('front/gallery/gallery.html.twig');
    }
}