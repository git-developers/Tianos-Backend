<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//use CoreBundle\Entity\CRUD_DUMMY;

class Load_9_CRUD_DUMMYData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


//        $entity = new CRUD_DUMMY();
//        $entity->setCode('11');
//        $entity->setName('CRUD_DUMMY 1');
//        $manager->persist($entity);
//
//        $entity = new CRUD_DUMMY();
//        $entity->setCode('22');
//        $entity->setName('CRUD_DUMMY 2');
//        $manager->persist($entity);
//
//        $entity = new CRUD_DUMMY();
//        $entity->setCode('33');
//        $entity->setName('CRUD_DUMMY 3');
//        $manager->persist($entity);
//
//        $entity = new CRUD_DUMMY();
//        $entity->setCode('44');
//        $entity->setName('CRUD_DUMMY 4');
//        $manager->persist($entity);
//
//        $entity = new CRUD_DUMMY();
//        $entity->setCode('55');
//        $entity->setName('CRUD_DUMMY 5');
//        $manager->persist($entity);
//
//        $entity = new CRUD_DUMMY();
//        $entity->setCode('66');
//        $entity->setName('CRUD_DUMMY 6');
//        $manager->persist($entity);
//
//        $manager->flush();



    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 11;
    }
}