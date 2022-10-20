<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

#[Route('/', name: "auth_")]
class AuthenticationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route(path: '/login', name: 'login', methods: ["GET", "POST"])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted("ROLE_USER_FULLY_VERIFIED")) {
            return $this->redirectToRoute('app_feed');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($error) {
            $this->addFlash("info", "Invalid credentials");
        }

        return $this->render('auth/login.html.twig');
    }

    #[Route(path: '/logout', name: 'logout', methods: ["GET"])]
    public function logout(): void
    {
    }

    #[Route('/register', name: "register", methods:["GET", "POST"])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        AppAuthenticator $authenticator,
    ): Response {

        if ($this->isGranted("ROLE_USER_FULLY_VERIFIED")) {
            return $this->redirectToRoute("app_feed");
        }

        if ($request->getMethod() === "POST") {
            $error = false;
            $email = $request->request->get("email");
            $username = $request->request->get("username");
            $password = $request->request->get("password");
            $passwordConfirm = $request->request->get("passwordConf");

            if ($password === "" || $passwordConfirm === "") {
                $error = true;
                $this->addFlash("info", "Your password cannot be empty");
            }

            if ($password !== $passwordConfirm) {
                $error = true;
                $this->addFlash("info", "Passwords must match");
            }

            $user = new User();

            $user->setEmail($email)
                 ->setUsername($username)
                 ->setRoles(["ROLE_USER_WAITING_FOR_VERIFICATION"])
                 ->setPassword(
                     $userPasswordHasher->hashPassword(
                         $user,
                         $password
                     )
                 );

            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                $error = true;

                /** @var ConstraintViolation $validationError */
                foreach ($errors as $validationError) {
                    $this->addFlash("info", $validationError->getMessage());
                }
            }

            if ($error) {
                return $this->render('auth/register.html.twig');
            }

            $entityManager->persist($user);
            $entityManager->flush();

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

            $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );

            return $this->redirectToRoute("auth_waiting_for_verif");
        }

        return $this->render("auth/register.html.twig");
    }

    #[Route('/verify/email', name: 'verify_email', methods:["GET"])]
    public function verifyUserEmail(
        Request $request,
        TranslatorInterface $translator,
        UserRepository $userRepository,
    ): Response {

        if ($this->isGranted("ROLE_USER_FULLY_VERIFIED")) {
            return $this->redirectToRoute("app_feed");
        }

        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('auth_login');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('auth_login');
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
            return $this->redirectToRoute('auth_login');
        }

        $this->addFlash('success', 'Your email address has been verified.');
        return $this->redirectToRoute("app_feed");
    }

    #[Route("/verify/pending", name: "waiting_for_verif", methods:["GET"])]
    public function waitingVerification(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute("auth_login");
        }

        if ($user !== null && $this->isGranted("ROLE_USER_FULLY_VERIFIED")) {
            return $this->redirectToRoute("app_feed");
        }

        $email = $user->getEmail();

        return $this->render("auth/verification.html.twig", [
            "email" => $email
        ]);
    }
}
