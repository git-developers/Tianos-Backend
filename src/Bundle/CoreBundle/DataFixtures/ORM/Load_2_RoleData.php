<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\RoleBundle\Entity\Role;
use Bundle\ProfileBundle\Entity\Profile;

class Load_2_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * DEFAULTS
         */
        $entity = new Role();
        $entity->setName('Role Admin');
        $entity->setSlug('ROLE_' . Profile::ADMIN);
        $entity->setGroupRol('admin');
        $entity->setGroupRolTag('group-admin');
        $manager->persist($entity);
        $this->addReference('role-admin', $entity);

        $entity = new Role();
        $entity->setName('Role Regular User');
        $entity->setSlug('ROLE_' . Profile::REGULAR_USER);
        $entity->setGroupRol('regular-user');
        $entity->setGroupRolTag('group-regular-user');
        $manager->persist($entity);
        $this->addReference('role-regular-user', $entity);

        $entity = new Role();
        $entity->setName('Role Guest');
        $entity->setSlug('ROLE_' . Profile::GUEST);
        $entity->setGroupRol('guest');
        $entity->setGroupRolTag('group-guest');
        $manager->persist($entity);
        $this->addReference('role-guest', $entity);




        /**
         * USER
         */
        $entity = new Role();
        $entity->setName('User create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('usuario');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-create', $entity);

        $entity = new Role();
        $entity->setName('User edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('usuario');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-edit', $entity);

        $entity = new Role();
        $entity->setName('User view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('usuario');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-view', $entity);

        $entity = new Role();
        $entity->setName('User delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('usuario');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-user-delete', $entity);



        /**
         * CLIENT
         */
        $entity = new Role();
        $entity->setName('Client create');
        $entity->setSlug('ROLE_CLIENT_CREATE');
        $entity->setGroupRol('cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-create', $entity);

        $entity = new Role();
        $entity->setName('client edit');
        $entity->setSlug('ROLE_CLIENT_EDIT');
        $entity->setGroupRol('cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-edit', $entity);

        $entity = new Role();
        $entity->setName('client view');
        $entity->setSlug('ROLE_CLIENT_VIEW');
        $entity->setGroupRol('cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-view', $entity);

        $entity = new Role();
        $entity->setName('client delete');
        $entity->setSlug('ROLE_CLIENT_DELETE');
        $entity->setGroupRol('cliente');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);
        $this->addReference('role-client-delete', $entity);



        /**
         * PDV
         */
        $entity = new Role();
        $entity->setName('Pdv create');
        $entity->setSlug('ROLE_PDV_CREATE');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-create', $entity);

        $entity = new Role();
        $entity->setName('Pdv edit');
        $entity->setSlug('ROLE_PDV_EDIT');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-edit', $entity);

        $entity = new Role();
        $entity->setName('Pdv view');
        $entity->setSlug('ROLE_PDV_VIEW');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-view', $entity);

        $entity = new Role();
        $entity->setName('Pdv delete');
        $entity->setSlug('ROLE_PDV_DELETE');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $manager->persist($entity);
        $this->addReference('role-pdv-delete', $entity);



        /**
         * CATEGORY
         */
        $entity = new Role();
        $entity->setName('Category create');
        $entity->setSlug('ROLE_CATEGORY_CREATE');
        $entity->setGroupRol('categoria');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-create', $entity);

        $entity = new Role();
        $entity->setName('Category edit');
        $entity->setSlug('ROLE_CATEGORY_EDIT');
        $entity->setGroupRol('categoria');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-edit', $entity);

        $entity = new Role();
        $entity->setName('Category view');
        $entity->setSlug('ROLE_CATEGORY_VIEW');
        $entity->setGroupRol('categoria');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-view', $entity);

        $entity = new Role();
        $entity->setName('Category delete');
        $entity->setSlug('ROLE_CATEGORY_DELETE');
        $entity->setGroupRol('categoria');
        $entity->setGroupRolTag('group-category');
        $manager->persist($entity);
        $this->addReference('role-category-delete', $entity);



        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}