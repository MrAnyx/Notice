<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// https://fosrestbundle.readthedocs.io/en/3.x/param_fetcher_listener.html

#[Route('/api', name: "api_")]
#[IsGranted("ROLE_USER_FULLY_VERIFIED")]
class UserController extends AbstractController
{
    #[Route('/me', name: "me")]
    public function me(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        return $this->json($user, Response::HTTP_OK, [], ['groups' => ['public']]);
    }
}
