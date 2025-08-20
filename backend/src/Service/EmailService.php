<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class EmailService
{
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function sendVerificationEmail(User $user): void
    {
        $verificationUrl = $this->urlGenerator->generate(
            'auth_verify_email', // This should be the name of the route for email verification
            ['token' => $user->getEmailVerificationToken()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($user->getEmail())
            ->subject('Please confirm your email')
            ->html($this->twig->render('email/verification.html.twig', [
                'user' => $user,
                'verificationUrl' => $verificationUrl,
            ]));

        $this->mailer->send($email);
    }
}
