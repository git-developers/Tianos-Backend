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

        $dateCreatedAt = "2018-05-11";

        /**
         * USER
         */
        $entity = new Role();
        $entity->setName('User create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-user-create', $entity);

        $entity = new Role();
        $entity->setName('User edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-user-edit', $entity);

        $entity = new Role();
        $entity->setName('User view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-user-view', $entity);

        $entity = new Role();
        $entity->setName('User delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-user-delete', $entity);



        /**
         * CLIENT
         */
        $entity = new Role();
        $entity->setName('Client create');
        $entity->setSlug('ROLE_CLIENT_CREATE');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-client-create', $entity);

        $entity = new Role();
        $entity->setName('client edit');
        $entity->setSlug('ROLE_CLIENT_EDIT');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-client-edit', $entity);

        $entity = new Role();
        $entity->setName('client view');
        $entity->setSlug('ROLE_CLIENT_VIEW');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-client-view', $entity);

        $entity = new Role();
        $entity->setName('client delete');
        $entity->setSlug('ROLE_CLIENT_DELETE');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-pdv-create', $entity);

        $entity = new Role();
        $entity->setName('Pdv edit');
        $entity->setSlug('ROLE_PDV_EDIT');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-pdv-edit', $entity);

        $entity = new Role();
        $entity->setName('Pdv view');
        $entity->setSlug('ROLE_PDV_VIEW');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-pdv-view', $entity);

        $entity = new Role();
        $entity->setName('Pdv delete');
        $entity->setSlug('ROLE_PDV_DELETE');
        $entity->setGroupRol('pdv');
        $entity->setGroupRolTag('group-pdv');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-pdv-delete', $entity);


        /**
         * PRODUCT
         */
        $entity = new Role();
        $entity->setName('Product create');
        $entity->setSlug('ROLE_PRODUCT_CREATE');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-product-create', $entity);

        $entity = new Role();
        $entity->setName('Product edit');
        $entity->setSlug('ROLE_PRODUCT_EDIT');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-product-edit', $entity);

        $entity = new Role();
        $entity->setName('Product view');
        $entity->setSlug('ROLE_PRODUCT_VIEW');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-product-view', $entity);

        $entity = new Role();
        $entity->setName('Product delete');
        $entity->setSlug('ROLE_PRODUCT_DELETE');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-product-delete', $entity);

        /**
         * CATEGORY
         */
        $entity = new Role();
        $entity->setName('Category create');
        $entity->setSlug('ROLE_CATEGORY_CREATE');
        $entity->setGroupRol('category');
        $entity->setGroupRolTag('group-category');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-category-create', $entity);

        $entity = new Role();
        $entity->setName('Category edit');
        $entity->setSlug('ROLE_CATEGORY_EDIT');
        $entity->setGroupRol('category');
        $entity->setGroupRolTag('group-category');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-category-edit', $entity);

        $entity = new Role();
        $entity->setName('Category view');
        $entity->setSlug('ROLE_CATEGORY_VIEW');
        $entity->setGroupRol('category');
        $entity->setGroupRolTag('group-category');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('role-category-view', $entity);

        $entity = new Role();
        $entity->setName('Category delete');
        $entity->setSlug('ROLE_CATEGORY_DELETE');
        $entity->setGroupRol('category');
        $entity->setGroupRolTag('group-category');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
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