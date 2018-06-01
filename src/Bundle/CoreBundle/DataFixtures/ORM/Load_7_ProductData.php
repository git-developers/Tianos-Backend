<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ProductBundle\Entity\Product;

class Load_7_ProductData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        /**
         * Marca PrenSmart
         */
        $entity = new Product();
        $entity->setCode('555');
        $entity->setName('Ojo');
        $entity->setSlug('product-5');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('999');
        $entity->setName('El Bocón');
        $entity->setSlug('product-9');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('222');
        $entity->setName('Correo');
        $entity->setSlug('product-2');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('111');
        $entity->setName('El Comercio');
        $entity->setSlug('product-1');
        $manager->persist($entity);




        /**
         * Marca El Comercio
         */
        $entity = new Product();
        $entity->setCode('1010');
        $entity->setName('Gestión');
        $entity->setSlug('product-10');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('444');
        $entity->setName('Trome');
        $entity->setSlug('product-4');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('333');
        $entity->setName('Perú 21');
        $entity->setSlug('product-3');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('888');
        $entity->setName('Depor');
        $entity->setSlug('product-8');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 7;
    }
}