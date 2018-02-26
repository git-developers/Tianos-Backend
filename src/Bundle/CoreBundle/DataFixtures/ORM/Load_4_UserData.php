<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_4_UserData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $client1 = $this->getReference('client-1');
        $client2 = $this->getReference('client-2');

        $profileAdmin = $this->getReference('profile-admin');

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setPassword('123');
        $entity->setName('Alfredo');
        $entity->setLastName('Bringas');
        $entity->setEmail('abringas@' . $this->applicationUrl);
        $entity->setIsActive(true);
        $entity->setClient($client1);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('12345677');
        $entity->setPassword('123');
        $entity->setName('Alan');
        $entity->setLastName('Garcia');
        $entity->setEmail('agarcia-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setIsActive(true);
        $entity->setClient($client1);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('87654321');
        $entity->setPassword('123');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setEmail('aeinstein-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client1);
        $entity->setProfile($profileAdmin);
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('88889999');
        $entity->setPassword('123');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('22334455');
        $entity->setPassword('123');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('123');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setIsActive(true);
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}