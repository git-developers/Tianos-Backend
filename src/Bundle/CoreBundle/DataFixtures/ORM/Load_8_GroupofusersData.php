<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\GroupofusersBundle\Entity\Groupofusers;

class Load_8_GroupofusersData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        $entity = new Groupofusers();
        $entity->setCode('111');
        $entity->setName('Grupo 1');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new Groupofusers();
        $entity->setCode('222');
        $entity->setName('Grupo 2');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new Groupofusers();
        $entity->setCode('333');
        $entity->setName('Grupo 3');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 8;
    }
}