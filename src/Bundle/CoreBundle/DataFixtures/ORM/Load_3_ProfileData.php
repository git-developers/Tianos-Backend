<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ProfileBundle\Entity\Profile;

class Load_3_ProfileData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $roleBackend = $this->getReference('role-backend');


        $entity = new Profile();
        $entity->setName(Profile::ADMIN);
//        $entity->addRole($roleBackend);
        $manager->persist($entity);
        $this->addReference('profile-admin', $entity);


        $entity = new Profile();
        $entity->setName('Conductor');
        $manager->persist($entity);

        $entity = new Profile();
        $entity->setName('Despachador');
        $manager->persist($entity);

        $entity = new Profile();
        $entity->setName(Profile::GUEST);
//        $entity->addRole($roleBackend);
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