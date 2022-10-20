<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route("/api", name: "api_")]
class AuthenticationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/verify/pending/send', name: "verify_pending_send", methods:["GET"])]
    public function blababla()
    {
        /** @var User $user */

        $user = $this->getUser();
        if ($user === null) {
            return;
        }

        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation(
            'auth_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('noreply@notice.test', 'Noreply - Notice'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('email/confirmation/email.html.twig')
        );
    }
}
