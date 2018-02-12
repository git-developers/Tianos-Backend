<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\RoleBundle\Entity\Role;

class Load_2_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        /**
         * ROLE_ADMIN
         */
        $entity = new Role();
        $entity->setName('administrator');
        $entity->setSlug('ROLE_ADMIN');
//        $entity->setGroupRol('backend');
//        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-backend', $entity);

        $entity = new Role();
        $entity->setName('vendedor');
        $entity->setSlug('ROLE_USER');
//        $entity->setGroupRol('backend');
//        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-vendedor', $entity);

        $entity = new Role();
        $entity->setName('editor');
        $entity->setSlug('ROLE_USER');
//        $entity->setGroupRol('backend');
//        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-editor', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}