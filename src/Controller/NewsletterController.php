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
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $newsletter = new Newsletter();

        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newsletter = $form->getData();

            $message = (new \Swift_Message('Newsletter'))
                // On attribue l'expéditeur
                ->setFrom('gbauvin@gmail.fr')

                // On attribue le destinataire
                ->setTo($newsletter->getEmail())

                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig', compact('newsletter')
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            $this->addFlash('success', 'Vous êtes bien inscrit à la newsletter');

            return $this->redirectToRoute('product');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}