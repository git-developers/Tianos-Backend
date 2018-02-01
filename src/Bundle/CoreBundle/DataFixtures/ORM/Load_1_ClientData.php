<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ClientBundle\Entity\Client;

class Load_1_ClientData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Client();
        $entity->setCode('111');
        $entity->setName('CLIENT-1');
        $manager->persist($entity);
        $this->addReference('client-1', $entity);

        $entity = new Client();
        $entity->setCode('222');
        $entity->setName('CLIENT-2');
        $manager->persist($entity);
        $this->addReference('client-2', $entity);

        $entity = new Client();
        $entity->setCode('333');
        $entity->setName('CLIENT-3');
        $manager->persist($entity);

        $entity = new Client();
        $entity->setCode('444');
        $entity->setName('CLIENT-4');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}