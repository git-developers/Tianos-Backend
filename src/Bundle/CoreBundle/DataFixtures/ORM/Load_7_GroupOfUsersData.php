<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\GroupOfUsers;

class Load_4_GroupOfUsersData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Alianza Lima');
        $manager->persist($entity);

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Universitario');
        $manager->persist($entity);

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Ciclista Lima');
        $manager->persist($entity);

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Union Comercio');
        $manager->persist($entity);

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Aprista');
        $manager->persist($entity);

        $entity = new GroupOfUsers();
        $entity->setGroupName('Grupo Sport Rosario');
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