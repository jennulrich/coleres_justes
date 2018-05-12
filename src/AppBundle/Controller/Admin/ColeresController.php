<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 12/05/2018
 * Time: 15:22
 */

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Coleres;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ColeresController extends Controller
{
    /**
     * @Route("/admin/coleres", name="admin_coleres")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $coleres = $em->getRepository(Coleres::class)
            ->findAll();
        return $this->render('admin/coleres/coleres.html.twig', [
            "coleres" => $coleres
        ]);
    }
}