<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class RegistrationVerificationWaitingEventSubscriber implements EventSubscriberInterface
{
    private const AVAILABLE_ROUTES = [
        "auth_waiting_for_verif",
        "auth_verify_email"
    ];

    private $authChecker;
    private $router;

    public function __construct(AuthorizationCheckerInterface $authChecker, UrlGeneratorInterface $router)
    {
        $this->authChecker = $authChecker;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $request)
    {
        $routeName = $request->getRequest()->attributes->get('_route');
        if ($this->authChecker->isGranted("ROLE_USER_WAITING_FOR_VERIFICATION") && !in_array($routeName, self::AVAILABLE_ROUTES)) {
            return new RedirectResponse($this->router->generate('auth_waiting_for_verif'));
        }
    }
}
