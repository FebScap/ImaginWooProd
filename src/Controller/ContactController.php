<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = '';
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $confirmMail = (new TemplatedEmail())
                ->from(new Address('clubphoto@imaginwoo.be', "Imagin'Woo"))
                ->to('imaginwoo@gmail.com')
                ->subject("Confirmation Imagin'Woo.be")
                ->htmlTemplate('contact/email.html.twig')
                ->context([
                    'text' => "Prise de contact Imagin'Woo. Ceci est une confirmation d'envoi, nous vous répondrons dans les plus brefs délais.",
                    'content' => $contact
                ]);

            $mail = (new TemplatedEmail())
                ->from(new Address('clubphoto@imaginwoo.be', "Imagin'Woo"))
                ->to($contact['email'])
                ->subject("Confirmation de contact avec Imagin'Woo.be")
                ->htmlTemplate('contact/email.html.twig')
                ->context([
                    'text' => "Vous avez reçu un nouveau message via votre formulaire de contact Imagin'Woo",
                    'content' => $contact
                ]);

            try {
                $mailer->send($mail);
                $mailer->send($confirmMail);
            } catch (TransportExceptionInterface $e) {
                return $this->render('error.html.twig', [
                    'error' => $e,
                ]);
            }
            return $this->redirectToRoute('app_contact_success', $contact);
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/success', name: 'app_contact_success')]
    public function success(): Response
    {
        return $this->render('popup.html.twig', [
            'title' => 'Mail envoyé !',
        ]);
    }
}
