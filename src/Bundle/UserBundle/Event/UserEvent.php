<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Event;

use Component\User\Model\UserInterface;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
