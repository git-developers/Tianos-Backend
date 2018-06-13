<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class BaseDoctrineListenerService
{

    protected $dateTime;
    protected $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->dateTime = new \DateTime();
        $this->tokenStorage = $tokenStorage;
    }

    public function setupCreatedAt($entity)
    {
        $createdAt = $entity->getCreatedAt();

        if(is_null($createdAt)){
            return $this->dateTime;
        }

        return $createdAt;
    }

    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}