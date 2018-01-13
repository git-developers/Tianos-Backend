<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Component\User\Model\UserInterface;
use Component\User\Security\PasswordUpdaterInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class PasswordUpdaterListener
{
    /**
     * @var PasswordUpdaterInterface
     */
    private $passwordUpdater;

    /**
     * @param PasswordUpdaterInterface $passwordUpdater
     */
    public function __construct(PasswordUpdaterInterface $passwordUpdater)
    {
        $this->passwordUpdater = $passwordUpdater;
    }

    /**
     * @param GenericEvent $event
     */
    public function genericEventUpdater(GenericEvent $event): void
    {
        $this->updatePassword($event->getSubject());
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function prePersist(LifecycleEventArgs $event): void
    {
        $user = $event->getEntity();

        if (!$user instanceof UserInterface) {
            return;
        }

        $this->updatePassword($user);
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function preUpdate(LifecycleEventArgs $event): void
    {
        $user = $event->getEntity();

        if (!$user instanceof UserInterface) {
            return;
        }

        $this->updatePassword($user);
    }

    /**
     * @param UserInterface $user
     */
    protected function updatePassword(UserInterface $user): void
    {
        if (null !== $user->getPlainPassword()) {
            $this->passwordUpdater->updatePassword($user);
        }
    }
}
