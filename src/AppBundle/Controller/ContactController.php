<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     * @return Response
     * @Method({"GET","POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     */
    public function indexAction(Request $request, \Swift_Mailer $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $message = (new \Swift_Message('Demande de contact'))
                ->setFrom('test@test.fr')
                ->setTo('jennifer.calipel@gmail.com')
                ->setBody(
                    $this->renderView('front/emails/contact.html.twig', [
                        'contact' => $contact
                    ]), 'text/html'
                );
            $mailer->send($message);

            return $this->redirectToRoute('contact');
        }

        return $this->render('front/contact/contact.html.twig', [
            'form' => $form->createView()
        ]);

    }
}