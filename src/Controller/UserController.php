<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_feed')]
    public function feed(): Response
    {
        return $this->render('user/feed.html.twig');
    }

    #[Route('/hashtags', name: 'app_hashtags')]
    public function hashtags(): Response
    {
        return $this->render('user/hashtags.html.twig');
    }

    #[Route('/collections', name: 'app_collections')]
    public function collections(): Response
    {
        return $this->render('user/collections.html.twig');
    }
}
