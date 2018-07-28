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
        $universityUni = $this->getReference('university-uni');

        $profileAdmin = $this->getReference('profile-admin');
        $profileGuest = $this->getReference('profile-guest');
        $profileRegularUser = $this->getReference('profile-regular-user');


        $entity = new User();
        $entity->setDni('87654321');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setEmail('aeinstein-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setUniversity($universityUni);
        $entity->setProfile($profileRegularUser);
        $manager->persist($entity);
        $this->addReference('user-2', $entity);

        $entity = new User();
        $entity->setDni('22334455');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setUniversity($universityUni);
        $entity->setProfile($profileRegularUser);
        $manager->persist($entity);
        $this->addReference('user-4', $entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setUniversity($universityUni);
        $entity->setProfile($profileRegularUser);
        $manager->persist($entity);
        $this->addReference('user-5', $entity);

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setPassword('123');
        $entity->setName('Alfredo');
        $entity->setLastName('Bringas');
        $entity->setEmail('abringas@' . $this->applicationUrl);
        $entity->setUniversity($universityUni);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);
        $this->addReference('user-1', $entity);

        $entity = new User();
        $entity->setDni('88889999');
        $entity->setPassword('123');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs@' . $this->applicationUrl);
        $entity->setUniversity($universityUni);
        $entity->setProfile($profileRegularUser);
        $manager->persist($entity);
        $this->addReference('user-3', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}