<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\ContactFormType;

class ContactController extends AbstractController
{
    public function showForm(): Response
    {
        $form = $this->createForm(ContactFormType::class);

        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function submitForm(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $subject = $formData['subject'] ?? '';
            if ($subject !== '') {
                $email = (new Email())
                    ->from($formData['email'])
                    ->to('mixed_vinyl@gmail.com')
                    ->subject($subject)
                    ->text($formData['message']);

                $mailer->send($email);
                return $this->redirectToRoute('confirmation');
            }
        }
        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
