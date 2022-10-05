<?php

namespace App\Services;

use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class UserService
{
   
    public static function envoyerMailConfirmation(Request $request, EmailVerifier $emailVerifier, \App\Entity\GRUser $user): void
    {
        try {
            $emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('GR-admin@gmail.com', 'Accueil Co-working'))
                    ->to($user->getEmail())
                    ->subject('Veuillez confirmer votre mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $request->getSession()->getFlashBag()->add('success', 'Nous avons envoyé un mail de confirmation.');
        } catch (TransportExceptionInterface $exception) {
            $request->getSession()->getFlashBag()->add('danger', $exception->getMessage());
        }

    }



}