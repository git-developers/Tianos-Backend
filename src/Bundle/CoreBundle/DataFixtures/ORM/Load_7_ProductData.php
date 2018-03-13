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

        $entity = new Product();
        $entity->setCode('111');
        $entity->setName('Product 1');
        $entity->setSlug('product-1');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('222');
        $entity->setName('Product 2');
        $entity->setSlug('product-2');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('333');
        $entity->setName('Product 3');
        $entity->setSlug('product-3');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('444');
        $entity->setName('Product 4');
        $entity->setSlug('product-4');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('555');
        $entity->setName('Product 5');
        $entity->setSlug('product-5');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('666');
        $entity->setName('Product 6');
        $entity->setSlug('product-6');
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