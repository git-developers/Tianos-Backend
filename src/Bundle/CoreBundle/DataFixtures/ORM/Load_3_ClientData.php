<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Client;

class Load_11_ClientData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Client();
        $entity->setName('Client 1');
        $entity->setDescription('Description client 1');
        $manager->persist($entity);
        $this->addReference('client-1', $entity);

        $entity = new Client();
        $entity->setName('Client 2');
        $entity->setDescription('Description client 2');
        $manager->persist($entity);
        $this->addReference('client-2', $entity);

        $entity = new Client();
        $entity->setName('Client 3');
        $entity->setDescription('Description client 3');
        $manager->persist($entity);

        $entity = new Client();
        $entity->setName('Client 4');
        $entity->setDescription('Description client 4');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}