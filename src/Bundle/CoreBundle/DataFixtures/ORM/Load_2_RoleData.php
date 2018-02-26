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
        $entity->setName('User create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-create', $entity);

        $entity = new Role();
        $entity->setName('User edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-edit', $entity);

        $entity = new Role();
        $entity->setName('User view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-view', $entity);

        $entity = new Role();
        $entity->setName('User delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-delete', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}