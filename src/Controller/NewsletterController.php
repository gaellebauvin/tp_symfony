<?php


namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewsletterController extends AbstractController
{
    /**
     * @Route("/precommande", name="precommande_form")
     */
    public function new(Request $request): Response
    {
        $newsletter = new Newsletter();

        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newsletter = $form->getData();

            $this->addFlash('success', 'Vous êtes bien inscrit à la newsletter');
            $this->redirectToRoute('')
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}