<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConceptController extends Controller
{
    /**
     * @Route("/concept", name="concept_page")
     */
    public function indexAction()
    {
        return $this->render('front/concept/concept.html.twig');
    }
}