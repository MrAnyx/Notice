<?php

namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: "api_")]
class AuthenticationController extends AbstractController
{
    #[Route('/login', name: 'login_check', methods:["POST"])]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json($user, Response::HTTP_OK, [], ["groups" => ["login"]]);
    }
}
