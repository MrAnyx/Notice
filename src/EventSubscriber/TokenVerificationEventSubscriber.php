<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;

class TokenVerificationEventSubscriber implements EventSubscriberInterface
{
    private const AUTHENTICATED_CONTROLLERS = [
        \App\Controller\Api\UserController::class
    ];

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $request)
    {
        $controllerMethod = $request->getRequest()->get("_controller");
        $controller = explode("::", $controllerMethod)[0];

        /** @var User $user */
        $user = $this->security->getUser();

        if (in_array($controller, self::AUTHENTICATED_CONTROLLERS)) {
            $token = $request->getRequest()->headers->get("X-AUTH-TOKEN");
            if ($token === null || $token !== $user->getToken()) {
                throw new UnauthorizedHttpException("User token is missing. Please log in before using this url");
            }
        }
    }
}
