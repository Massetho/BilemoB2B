<?php
// api/src/EventSubscriber/BookMailSubscriber.php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use App\Service\PasswordEncryptor;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UserCreationSubscriber implements EventSubscriberInterface
{
    private $passwordEncryptor;

    public function __construct(PasswordEncryptor $passwordEncryptor)
    {
        $this->passwordEncryptor = $passwordEncryptor;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['handleUserCreation', EventPriorities::PRE_WRITE],
        ];
    }

    public function handleUserCreation(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        $this->passwordEncryptor->encodePassword($user);

        $user->setDateCreated(new \DateTime());
        $roles =$user->getRoles();
        array_push($roles, 'ROLE_ADMIN');
        $user->setRoles(array_unique($roles));
    }
}