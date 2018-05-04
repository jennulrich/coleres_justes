<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coleres;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ColeresController extends Controller
{
    /**
     * @Route("/coleres/{id}", name="coleres_view", requirements={"id"="\d+"})
     * @param $id int
     * @return Response
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $colere = $em->getRepository(Coleres::class)
            ->find($id);
        return $this->render('front/coleres/coleres-detail.html.twig', [
            "colere" => $colere
        ]);
    }

    /**
     * @Route("/coleres", name="coleres")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $coleres = $em->getRepository(Coleres::class)
            ->findAll();
        return $this->render('front/coleres/coleres.html.twig', [
            "coleres" => $coleres
        ]);
    }
}