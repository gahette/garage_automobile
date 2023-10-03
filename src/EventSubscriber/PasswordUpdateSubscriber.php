<?php

namespace App\EventSubscriber;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordUpdateSubscriber implements EventSubscriberInterface
{
    public function __construct(protected UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function onBeforeEntityPersistedEvent(BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!$entity instanceof Users) {
            return;
        }
        if (!is_null($entity->getPlainPassword()) && '' != $entity->getPlainPassword()) {
            $entity->setPassword(
                $this->passwordHasher->hashPassword($entity, $entity->getPlainPassword())
            );
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'onBeforeEntityPersistedEvent',
            BeforeEntityUpdatedEvent::class => 'onBeforeEntityPersistedEvent',
        ];
    }
}
