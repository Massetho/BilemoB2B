<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\CustomerUser;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class CustomerUserCreationSubscriber implements EventSubscriberInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CustomerUserCreationSubscriber constructor.
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['handleUserCreation', EventPriorities::PRE_WRITE],
        ];
    }

    public function handleUserCreation(GetResponseForControllerResultEvent $event)
    {
        $customerUser = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$customerUser instanceof CustomerUser || Request::METHOD_POST !== $method) {
            return;
        }

        $customerUser->setUser($this->tokenStorage->getToken()->getUser());
    }
}