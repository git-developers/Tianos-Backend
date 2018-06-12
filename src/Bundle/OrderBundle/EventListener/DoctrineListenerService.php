<?php

declare(strict_types=1);

namespace Bundle\OrderBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\OrderBundle\Entity\Order;
use Cocur\Slugify\Slugify;

// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

class DoctrineListenerService implements EventSubscriber
{
    protected $dateTime;
    protected $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->dateTime = new \DateTime();
        $this->tokenStorage = $tokenStorage;
    }

    public function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'preUpdate',
            'prePersist',
            'preRemove',
            'preFlush',
            'postFlush',
            'postPersist',
            'postUpdate',
            'postRemove',
            'postLoad',
            'onFlush',
        ];
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof Order){
//            $name = $entity->getName();
//            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->dateTime);

            return;
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Order){
            $entity->setUpdatedAt($this->dateTime);

            return;
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Orderin){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Order){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Order){

            return;
        }
    }

    private function slugify($string, $separator = '-')
    {
        $slugify = new Slugify(['lowercase' => true, 'separator' => $separator, 'ruleset' => 'default']);
        return $slugify->slugify($string);
    }

}






