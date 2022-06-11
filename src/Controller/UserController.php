<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/", name:"app_")]
#[IsGranted("ROLE_USER_FULLY_VERIFIED")]
class UserController extends AbstractController
{
    #[Route('/', name: 'feed')]
    public function feed(): Response
    {
        return $this->render('user/feed.html.twig');
    }

    #[Route('/hashtags', name: 'hashtags')]
    public function hashtags(): Response
    {
        return $this->render('user/hashtags.html.twig');
    }

    #[Route('/collections', name: 'collections')]
    public function collections(): Response
    {
        return $this->render('user/collections.html.twig');
    }
}
