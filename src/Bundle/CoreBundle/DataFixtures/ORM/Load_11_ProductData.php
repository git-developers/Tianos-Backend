<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Product;

class Load_9_ProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new Product();
        $entity->setCode('11');
        $entity->setName('Product 1');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('22');
        $entity->setName('Product 2');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('33');
        $entity->setName('Product 3');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('44');
        $entity->setName('Product 4');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('55');
        $entity->setName('Product 5');
        $manager->persist($entity);

        $entity = new Product();
        $entity->setCode('66');
        $entity->setName('Product 6');
        $manager->persist($entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 11;
    }
}