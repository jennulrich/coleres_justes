<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\About;
use AppBundle\Form\AboutType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AboutController extends Controller
{
    /**
     * @Route("/admin/about", name="admin_about")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $abouts = $em->getRepository(About::class)
            ->findAll();
        return $this->render('admin/about/about.html.twig', [
            "abouts" => $abouts
        ]);
    }

    /**
     * @Route("/admin/about/{id}/edit", name="admin_edit_about", requirements={"id"="\d+"})
     */
    public function editAction(int $id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $about = $em->getRepository(About::class)
            ->find($id);
        $about->setImage(null);
        $form = $this->createForm(AboutType::class, $about);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush();
            return $this->redirectToRoute('admin_about', [
                "id"=>$about->getId(),
            ]);
        }

        return $this->render('admin/about/edit-about.html.twig', [
            'form' => $form->createView(),
            'about' => $about
        ]);
    }

    /**
     * @Route("/admin/about/{id}/image", name="about_image", requirements={"id"="\d+"})
     */
    public function ImageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $about = $em->getRepository(About::class)
            ->find($id);
        $file = $this->getParameter("images_directory")."/".$about->getImage();
        return new BinaryFileResponse($file);
    }
}
