<?php

namespace Bundle\CoreBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use CoreBundle\Entity\PointOfSale;
use CoreBundle\Entity\Client;
use CoreBundle\Entity\User;
use CoreBundle\Entity\Category;
use CoreBundle\Entity\Role;
use CoreBundle\Entity\Profile;
use CoreBundle\Entity\Files;
use CoreBundle\Entity\CategoryHasProduct;
use CoreBundle\Entity\FileMimeType;
use CoreBundle\Entity\GroupOfUsers;
//use CoreBundle\Entity\Product;
use CoreBundle\Entity\Template;
use CoreBundle\Entity\TemplateModule;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEParagraph;
use CoreBundle\Entity\PointOfSaleHasProduct;
use CoreBundle\Entity\TemplateEPost;
use CoreBundle\Entity\TemplateEItem;
use Cocur\Slugify\Slugify;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

class DoctrineListenerService implements EventSubscriber
{

    protected $container;
    protected $dateTime;
    protected $tokenStorage;
    protected $active;
    protected $uniqid;

    public function __construct(ContainerInterface $container, TokenStorage $tokenStorage)
    {
        $this->container = $container;
        $this->dateTime = new \DateTime();
        $this->tokenStorage = $tokenStorage;
        $this->active = true;
        $this->uniqid = uniqid();
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
        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof User){
//            $name = $this->name($entity->getEmail());

            $plainPassword = $entity->getPassword();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($entity, $plainPassword);
            $entity->setPassword($encoded);

            $this->uniqid = uniqid();
            $name = $entity->getName();
            $entity->setSlug($this->makeSlug($this->uniqid, $name, 90));

            $entity->setUsername($this->uniqid);
            $entity->setUsernameCanonical($this->uniqid);
            $entity->setCreatedAt($this->dateTime);
            $entity->setIsActive($this->active);
            $entity->setEnabled($this->active);

            return;
        }else if ($entity instanceof Profile){
            $name = $entity->getName();
            $name = $this->slugify($name);
            $entity->setSlug($name);
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Files){
            $uniqid = $entity->getUniqueId();
            $name = $entity->getName();
            $entity->setSlug($this->makeSlug($uniqid, $name, 90));
            $entity->setCreatedAt($this->dateTime);
            $entity->setIsActive($this->active);

            return;
        }else if ($entity instanceof FileMimeType){
            $entity->setCreatedAt($this->dateTime);
            $entity->setIsActive($this->active);
            $entity->setView(FileMimeType::VIEW_DOC);

            return;
        }else if ($entity instanceof PointOfSale){
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Role){
            $name = $entity->getSlug();
            $name = $this->slugify($name, '_');
            $name = strtoupper($name);

            $entity->setSlug($name);
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Client){
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Category){
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof CategoryHasProduct){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof GroupOfUsers){
            $name = $entity->getGroupName();
            $entity->setSlug($this->slugify($name));

            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof PointOfSaleHasProduct){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Template){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof TemplateModule){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof TemplateHasModule){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof TemplateEParagraph){
            $entity->setCreatedAt($this->dateTime);

            return;
//        }else if ($entity instanceof Product){
//            $name = $entity->getName();
//            $entity->setSlug($this->slugify($name));
//            $entity->setCreatedAt($this->dateTime);
//
//            return;
        }else if ($entity instanceof TemplateEPost){
            $entity->setCreatedAt($this->dateTime);

            return;
        }else if ($entity instanceof TemplateEItem){
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
        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof User){
//            $entity->setLastAccess($this->dateTime);
            $entity->setUpdatedAt($this->dateTime);

//            if ($entity->hasChangedField('image')) {
//                // Do something when the username is changed.
//            }

            return;
        }else if ($entity instanceof Files) {

            $uniqid = $entity->getUniqueId();
            $name = $entity->getName();
            $entity->setUniqueId($uniqid);
            $entity->setSlug($this->makeSlug($uniqid, $name, 90));
            $entity->setUpdatedAt($this->dateTime);
//            $entity->setIsActive($this->active);

            return;
        }else if ($entity instanceof Category){

//            $id = $entity->getIdIncrement();
//            $repository = $entityManager->getRepository(CategoryHasProduct::class);
//            $children = $repository->findProductsByCategory($id);
//
//            foreach ($children as $key => $category){
////                echo '<pre> POLLO 333:: ';
////                print_r($category->getIdIncrement());
////                echo '<br>';
//
//                $entityManager->remove($category);
//
//            }
//
//            $entityManager->flush();

//            exit;

            $entity->setUpdatedAt($this->dateTime);

            return;
        }else if ($entity instanceof GroupOfUsers){
            $name = $entity->getGroupName();
            $entity->setSlug($this->slugify($name));

            $entity->setUpdatedAt($this->dateTime);

            return;
        }else if ($entity instanceof Role){
            $name = $entity->getSlug();
            $name = $this->slugify($name, '_');
            $name = strtoupper($name);

            $entity->setSlug($name);
            $entity->setUpdatedAt($this->dateTime);

            return;
        }else if ($entity instanceof PointOfSaleHasProduct){
            $entity->setUpdatedAt($this->dateTime);

            return;
        }else if ($entity instanceof TemplateHasModule){
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
        $entityManager = $args->getEntityManager();

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
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Files){
            $entity->setUpdatedAt($this->dateTime);
            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof User){

            $fileName = $entity->getImage();

            if(!is_null($fileName)){

                $entity->setImageFilter($fileName);

            }

//                $tmpImagePathRel = '/uploads/user/'.$fileName;
//                $processedImage = $this->container->get('liip_imagine.data.manager')->find('filter_160', $tmpImagePathRel);
//                $imagineCacheManager = $this->container->get('liip_imagine.filter.manager');
//                $resolvedPath = $imagineCacheManager->applyFilter($processedImage, 'filter_160')->getContent();

//            $imagineCacheManager = $this->container->get('liip_imagine.cache.manager');
//            $resolvedPath = $imagineCacheManager->getBrowserPath('../../uploads/user/'.$fileName, 'filter_160');

//            echo '<pre>';
//            print_r($resolvedPath);
//            exit;


            /*
            $directory = $this->container->getParameter('uploads_directory');
            $fileName = $entity->getImage();
            $path = $directory.'user/'.$fileName;

            if (!empty($fileName) && file_exists($path)) {
                $entity->setImage(new File($path));
            }
            */

            return;
        }

    }

    private function makeSlug($uniqid, $string, $length = 100)
    {
        $slug = $this->slugify($string);
        $slug = substr($slug, 0, $length);
        return $uniqid.'-'. $slug;
    }

    private function slugify($string, $separator = '-')
    {
        $slugify = new Slugify(['lowercase' => true, 'separator' => $separator, 'ruleset' => 'default']);
        return $slugify->slugify($string);
    }

    private function name($email)
    {
        try{
            list($name, $domain) = explode('@', trim($email));
            return preg_replace('/[0-9]+/', '', $this->slugify($name, ''));
        }catch (\Exception $e){
            return $this->uniqid;
        }
    }

}






