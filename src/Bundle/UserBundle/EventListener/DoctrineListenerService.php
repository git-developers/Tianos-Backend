<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\UserBundle\Entity\User;
use Cocur\Slugify\Slugify;
use Bundle\CoreBundle\EventListener\BaseDoctrineListenerService;

// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

class DoctrineListenerService extends BaseDoctrineListenerService implements EventSubscriber
{
    protected $encoder;

    public function __construct(TokenStorage $tokenStorage, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($tokenStorage);
        $this->encoder = $encoder;
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

        if ($entity instanceof User){

            $uniqid = uniqid();
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->setupCreatedAt($entity));
            $entity->setUsername($uniqid);
            $entity->setEnabled(true);
            $entity->setUsernameCanonical($uniqid);


            //password
            $plainPassword = $entity->getPassword();
            $encoded = $this->encoder->encodePassword($entity, $plainPassword);
            $entity->setPassword($encoded);

            return;
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){
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

        if ($entity instanceof User){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User){

            return;
        }
    }

    private function slugify($string, $separator = '-')
    {
        $slugify = new Slugify(['lowercase' => true, 'separator' => $separator, 'ruleset' => 'default']);
        return $slugify->slugify($string);
    }

}






