<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\User;

class Load_3_UserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client1 = $this->getReference('client-1');
        $client2 = $this->getReference('client-2');

        $profileEditor = $this->getReference('profile-editor');

        $entity = new User();
        $entity->setClient($client1);
        $entity->setDni('12345678');
        $entity->setPassword('123');
        $entity->setName('Alan');
        $entity->setLastName('Garcia');
        $entity->setEmail('agarcia-' . uniqid() . '@gmail.com');
        $entity->setIsActive(true);
        $entity->setProfile($profileEditor);
        $manager->persist($entity);

        $entity = new User();
        $entity->setClient($client1);
        $entity->setDni('87654321');
        $entity->setPassword('123');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setEmail('aeinstein-' . uniqid() . '@gmail.com');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setClient($client2);
        $entity->setDni('88889999');
        $entity->setPassword('123');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs-' . uniqid() . '@gmail.com');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setClient($client2);
        $entity->setDni('22334455');
        $entity->setPassword('123');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates-' . uniqid() . '@gmail.com');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setClient($client2);
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton-' . uniqid() . '@gmail.com');
        $entity->setIsActive(true);
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}