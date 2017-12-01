<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\PointOfSale;

class Load_1_PointOfSaleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new PointOfSale();
        $entity->setCode('11');
        $entity->setName('Jockey Plaza');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);

        $entity = new PointOfSale();
        $entity->setCode('22');
        $entity->setName('Plaza Vea');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);

        $entity = new PointOfSale();
        $entity->setCode('33');
        $entity->setName('Metro Hiper Mercado');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);

        $entity = new PointOfSale();
        $entity->setCode('44');
        $entity->setName('Movistar');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);

        $entity = new PointOfSale();
        $entity->setCode('55');
        $entity->setName('Claro');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);

        $entity = new PointOfSale();
        $entity->setCode('66');
        $entity->setName('El Comercio');
        $entity->setLatitude('1');
        $entity->setLongitude('2');
        $manager->persist($entity);


        $manager->flush();


        /*
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('test');

        $manager->persist($userAdmin);
        $manager->flush();

        $this->addReference('admin-user', $userAdmin);
        */


    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}