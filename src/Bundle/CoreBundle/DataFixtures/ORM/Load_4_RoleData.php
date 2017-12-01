<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Role;

class Load_11_RoleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        /**
         * ROLE_ADMIN
         */
        $entity = new Role();
        $entity->setName('backend');
        $entity->setSlug('ROLE_ADMIN');
        $entity->setGroupRol('backend');
        $entity->setGroupRolTag('group-backend');
        $manager->persist($entity);
        $this->addReference('role-backend', $entity);


        /**
         * ASSIGNTEMPLATEHASMODULE
         */
        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ASSIGNTEMPLATEHASMODULE_VIEW');
        $entity->setGroupRol('template has module');
        $entity->setGroupRolTag('group-assigntemplatehasmodule');
        $manager->persist($entity);
        $this->addReference('role-view-assigntemplatehasmodule', $entity);

        $entity = new Role();
        $entity->setName('assign');
        $entity->setSlug('ROLE_ASSIGNTEMPLATEHASMODULE_ASSIGN');
        $entity->setGroupRol('template has module');
        $entity->setGroupRolTag('group-assigntemplatehasmodule');
        $manager->persist($entity);
        $this->addReference('role-assign-assigntemplatehasmodule', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('template has module');
        $entity->setGroupRolTag('group-assigntemplatehasmodule');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('template has module');
        $entity->setGroupRolTag('group-assigntemplatehasmodule');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('template has module');
        $entity->setGroupRolTag('group-assigntemplatehasmodule');
        $manager->persist($entity);


        /**
         * ASSIGNGROUPHASUSER
         */
        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ASSIGNGROUPHASUSER_VIEW');
        $entity->setGroupRol('group has user');
        $entity->setGroupRolTag('group-assigngrouphasuser');
        $manager->persist($entity);
        $this->addReference('role-view-assigngrouphasuser', $entity);

        $entity = new Role();
        $entity->setName('assign');
        $entity->setSlug('ROLE_ASSIGNGROUPHASUSER_ASSIGN');
        $entity->setGroupRol('group has user');
        $entity->setGroupRolTag('group-assigngrouphasuser');
        $manager->persist($entity);
        $this->addReference('role-assign-assigngrouphasuser', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('group has user');
        $entity->setGroupRolTag('group-assigngrouphasuser');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('group has user');
        $entity->setGroupRolTag('group-assigngrouphasuser');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('group has user');
        $entity->setGroupRolTag('group-assigngrouphasuser');
        $manager->persist($entity);




        /**
         * ASSIGNUSERHASPOINTOFSALE
         */
        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ASSIGNUSERHASPOINTOFSALE_VIEW');
        $entity->setGroupRol('user has pdv');
        $entity->setGroupRolTag('group-assignuserhaspointofsale');
        $manager->persist($entity);
        $this->addReference('role-view-assignuserhaspointofsale', $entity);

        $entity = new Role();
        $entity->setName('assign');
        $entity->setSlug('ROLE_ASSIGNUSERHASPOINTOFSALE_ASSIGN');
        $entity->setGroupRol('user has pdv');
        $entity->setGroupRolTag('group-assignuserhaspointofsale');
        $manager->persist($entity);
        $this->addReference('role-assign-assignuserhaspointofsale', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('user has pdv');
        $entity->setGroupRolTag('group-assignuserhaspointofsale');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('user has pdv');
        $entity->setGroupRolTag('group-assignuserhaspointofsale');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('user has pdv');
        $entity->setGroupRolTag('group-assignuserhaspointofsale');
        $manager->persist($entity);



        /**
         * ASSIGNPOINTOFSALEHASPRODUCT
         */
        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ASSIGNPOINTOFSALEHASPRODUCT_VIEW');
        $entity->setGroupRol('pdv has prod');
        $entity->setGroupRolTag('group-assignpointofsalehasproduct');
        $manager->persist($entity);
        $this->addReference('role-view-assignpointofsalehasproduct', $entity);

        $entity = new Role();
        $entity->setName('assign');
        $entity->setSlug('ROLE_ASSIGNPOINTOFSALEHASPRODUCT_ASSIGN');
        $entity->setGroupRol('pdv has prod');
        $entity->setGroupRolTag('group-assignpointofsalehasproduct');
        $manager->persist($entity);
        $this->addReference('role-assign-assignpointofsalehasproduct', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('pdv has prod');
        $entity->setGroupRolTag('group-assignpointofsalehasproduct');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('pdv has prod');
        $entity->setGroupRolTag('group-assignpointofsalehasproduct');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('pdv has prod');
        $entity->setGroupRolTag('group-assignpointofsalehasproduct');
        $manager->persist($entity);



        /**
         * USER
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_USER_CREATE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-create-user', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_USER_EDIT');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-edit-user', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_USER_DELETE');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-delete-user', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_USER_VIEW');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-view-user', $entity);

        $entity = new Role();
        $entity->setName('changepassword');
        $entity->setSlug('ROLE_USER_CHANGEPASSWORD');
        $entity->setGroupRol('user');
        $entity->setGroupRolTag('group-user');
        $manager->persist($entity);
        $this->addReference('role-changepassword-user', $entity);


        /**
         * GROUPOFUSERS
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_GROUPOFUSERS_CREATE');
        $entity->setGroupRol('groupofusers');
        $entity->setGroupRolTag('group-groupofusers');
        $manager->persist($entity);
        $this->addReference('role-create-groupofusers', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_GROUPOFUSERS_EDIT');
        $entity->setGroupRol('groupofusers');
        $entity->setGroupRolTag('group-groupofusers');
        $manager->persist($entity);
        $this->addReference('role-edit-groupofusers', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_GROUPOFUSERS_DELETE');
        $entity->setGroupRol('groupofusers');
        $entity->setGroupRolTag('group-groupofusers');
        $manager->persist($entity);
        $this->addReference('role-delete-groupofusers', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_GROUPOFUSERS_VIEW');
        $entity->setGroupRol('groupofusers');
        $entity->setGroupRolTag('group-groupofusers');
        $manager->persist($entity);
        $this->addReference('role-view-groupofusers', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('groupofusers');
        $entity->setGroupRolTag('group-groupofusers');
        $manager->persist($entity);


        /**
         * POINT OF SALE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_POINTOFSALE_CREATE');
        $entity->setGroupRol('point of sale');
        $entity->setGroupRolTag('group-pointofsale');
        $manager->persist($entity);
        $this->addReference('role-create-pointofsale', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_POINTOFSALE_EDIT');
        $entity->setGroupRol('point of sale');
        $entity->setGroupRolTag('group-pointofsale');
        $manager->persist($entity);
        $this->addReference('role-edit-pointofsale', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_POINTOFSALE_DELETE');
        $entity->setGroupRol('point of sale');
        $entity->setGroupRolTag('group-pointofsale');
        $manager->persist($entity);
        $this->addReference('role-delete-pointofsale', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_POINTOFSALE_VIEW');
        $entity->setGroupRol('point of sale');
        $entity->setGroupRolTag('group-pointofsale');
        $manager->persist($entity);
        $this->addReference('role-view-pointofsale', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('point of sale');
        $entity->setGroupRolTag('group-pointofsale');
        $manager->persist($entity);


        /**
         * POINT OF SALE TREE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_POINTOFSALETREE_CREATE');
        $entity->setGroupRol('pdv tree');
        $entity->setGroupRolTag('group-pointofsale-tree');
        $manager->persist($entity);
        $this->addReference('role-create-pointofsaletree', $entity);

        $entity = new Role();
        $entity->setName('create child');
        $entity->setSlug('ROLE_POINTOFSALETREE_CREATECHILD');
        $entity->setGroupRol('pdv tree');
        $entity->setGroupRolTag('group-pointofsale-tree');
        $manager->persist($entity);
        $this->addReference('role-createchild-pointofsaletree', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_POINTOFSALETREE_EDIT');
        $entity->setGroupRol('pdv tree');
        $entity->setGroupRolTag('group-pointofsale-tree');
        $manager->persist($entity);
        $this->addReference('role-edit-pointofsaletree', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_POINTOFSALETREE_DELETE');
        $entity->setGroupRol('pdv tree');
        $entity->setGroupRolTag('group-pointofsale-tree');
        $manager->persist($entity);
        $this->addReference('role-delete-pointofsaletree', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_POINTOFSALETREE_VIEW');
        $entity->setGroupRol('pdv tree');
        $entity->setGroupRolTag('group-pointofsale-tree');
        $manager->persist($entity);
        $this->addReference('role-view-pointofsaletree', $entity);


        /**
         * CLIENT
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_CLIENT_CREATE');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_CLIENT_EDIT');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_CLIENT_DELETE');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_CLIENT_VIEW');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('client');
        $entity->setGroupRolTag('group-client');
        $manager->persist($entity);


        /**
         * CATEGORY
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_CATEGORYTREE_CREATE');
        $entity->setGroupRol('category tree');
        $entity->setGroupRolTag('group-category-tree');
        $manager->persist($entity);
        $this->addReference('role-create-categorytree', $entity);

        $entity = new Role();
        $entity->setName('create child');
        $entity->setSlug('ROLE_CATEGORYTREE_CREATECHILD');
        $entity->setGroupRol('category tree');
        $entity->setGroupRolTag('group-category-tree');
        $manager->persist($entity);
        $this->addReference('role-createchild-categorytree', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_CATEGORYTREE_EDIT');
        $entity->setGroupRol('category tree');
        $entity->setGroupRolTag('group-category-tree');
        $manager->persist($entity);
        $this->addReference('role-edit-categorytree', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_CATEGORYTREE_DELETE');
        $entity->setGroupRol('category tree');
        $entity->setGroupRolTag('group-category-tree');
        $manager->persist($entity);
        $this->addReference('role-delete-categorytree', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_CATEGORYTREE_VIEW');
        $entity->setGroupRol('category tree');
        $entity->setGroupRolTag('group-category-tree');
        $manager->persist($entity);
        $this->addReference('role-view-categorytree', $entity);




        /**
         * CATEGORYTREETOASSIGN
         */
        $entity = new Role();
        $entity->setName('assign');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_ASSIGN');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-assign-categorytreetoassign', $entity);

        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_CREATE');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-create-categorytreetoassign', $entity);

        $entity = new Role();
        $entity->setName('create child');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_CREATECHILD');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-createchild-categorytreetoassign', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_EDIT');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-edit-categorytreetoassign', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_DELETE');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-delete-categorytreetoassign', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_CATEGORYTREETOASSIGN_VIEW');
        $entity->setGroupRol('categ has product');
        $entity->setGroupRolTag('group-categorytreetoassign');
        $manager->persist($entity);
        $this->addReference('role-view-categorytreetoassign', $entity);



        /**
         * PRODUCT
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_PRODUCT_CREATE');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_PRODUCT_EDIT');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_PRODUCT_DELETE');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_PRODUCT_VIEW');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('product');
        $entity->setGroupRolTag('group-product');
        $manager->persist($entity);



        /**
         * ACLROLE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLROLE_CREATE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-create-aclrole', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLROLE_EDIT');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-edit-aclrole', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLROLE_DELETE');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-delete-aclrole', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLROLE_VIEW');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);
        $this->addReference('role-view-aclrole', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl role');
        $entity->setGroupRolTag('group-aclrole');
        $manager->persist($entity);



        /**
         * ACLPROFILE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_ACLPROFILE_CREATE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-create-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_ACLPROFILE_EDIT');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-edit-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_ACLPROFILE_DELETE');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-delete-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_ACLPROFILE_VIEW');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);
        $this->addReference('role-view-aclprofile', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('acl profile');
        $entity->setGroupRolTag('group-aclprofile');
        $manager->persist($entity);


        /**
         * TEMPLATE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_TEMPLATE_CREATE');
        $entity->setGroupRol('template');
        $entity->setGroupRolTag('group-template');
        $manager->persist($entity);
        $this->addReference('role-create-template', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_TEMPLATE_EDIT');
        $entity->setGroupRol('template');
        $entity->setGroupRolTag('group-template');
        $manager->persist($entity);
        $this->addReference('role-edit-template', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_TEMPLATE_DELETE');
        $entity->setGroupRol('template');
        $entity->setGroupRolTag('group-template');
        $manager->persist($entity);
        $this->addReference('role-delete-template', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_TEMPLATE_VIEW');
        $entity->setGroupRol('template');
        $entity->setGroupRolTag('group-template');
        $manager->persist($entity);
        $this->addReference('role-view-template', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('template');
        $entity->setGroupRolTag('group-template');
        $manager->persist($entity);


        /**
         * TEMPLATEMODULE
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_TEMPLATEMODULE_CREATE');
        $entity->setGroupRol('templ module');
        $entity->setGroupRolTag('group-templatemodule');
        $manager->persist($entity);
        $this->addReference('role-create-templatemodule', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_TEMPLATEMODULE_EDIT');
        $entity->setGroupRol('templ module');
        $entity->setGroupRolTag('group-templatemodule');
        $manager->persist($entity);
        $this->addReference('role-edit-templatemodule', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_TEMPLATEMODULE_DELETE');
        $entity->setGroupRol('templ module');
        $entity->setGroupRolTag('group-templatemodule');
        $manager->persist($entity);
        $this->addReference('role-delete-templatemodule', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_TEMPLATEMODULE_VIEW');
        $entity->setGroupRol('templ module');
        $entity->setGroupRolTag('group-templatemodule');
        $manager->persist($entity);
        $this->addReference('role-view-templatemodule', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ module');
        $entity->setGroupRolTag('group-templatemodule');
        $manager->persist($entity);


        /**
         * TEMPLATEECATEGORY
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_TEMPLATEECATEGORY_CREATE');
        $entity->setGroupRol('templ category');
        $entity->setGroupRolTag('group-templateecategory');
        $manager->persist($entity);
        $this->addReference('role-create-templateecategory', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_TEMPLATEECATEGORY_EDIT');
        $entity->setGroupRol('templ category');
        $entity->setGroupRolTag('group-templateecategory');
        $manager->persist($entity);
        $this->addReference('role-edit-templateecategory', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_TEMPLATEECATEGORY_DELETE');
        $entity->setGroupRol('templ category');
        $entity->setGroupRolTag('group-templateecategory');
        $manager->persist($entity);
        $this->addReference('role-delete-templateecategory', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_TEMPLATEECATEGORY_VIEW');
        $entity->setGroupRol('templ category');
        $entity->setGroupRolTag('group-templateecategory');
        $manager->persist($entity);
        $this->addReference('role-view-templateecategory', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ category');
        $entity->setGroupRolTag('group-templateecategory');
        $manager->persist($entity);


        /**
         * TEMPLATESETUP
         */
        $entity = new Role();
        $entity->setName('setup');
        $entity->setSlug('ROLE_TEMPLATESETUP');
        $entity->setGroupRol('templ setup');
        $entity->setGroupRolTag('group-templatesetup');
        $manager->persist($entity);
        $this->addReference('role-templatesetup', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ setup');
        $entity->setGroupRolTag('group-templatesetup');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ setup');
        $entity->setGroupRolTag('group-templatesetup');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ setup');
        $entity->setGroupRolTag('group-templatesetup');
        $manager->persist($entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ setup');
        $entity->setGroupRolTag('group-templatesetup');
        $manager->persist($entity);



        /**
         * TEMPLATESETUPEDIT
         */
        $entity = new Role();
        $entity->setName('create');
        $entity->setSlug('ROLE_TEMPLATESETUPEDIT_CREATE');
        $entity->setGroupRol('templ setup edit');
        $entity->setGroupRolTag('group-templatesetupedit');
        $manager->persist($entity);
        $this->addReference('role-create-templatesetupedit', $entity);

        $entity = new Role();
        $entity->setName('edit');
        $entity->setSlug('ROLE_TEMPLATESETUPEDIT_EDIT');
        $entity->setGroupRol('templ setup edit');
        $entity->setGroupRolTag('group-templatesetupedit');
        $manager->persist($entity);
        $this->addReference('role-edit-templatesetupedit', $entity);

        $entity = new Role();
        $entity->setName('delete');
        $entity->setSlug('ROLE_TEMPLATESETUPEDIT_DELETE');
        $entity->setGroupRol('templ setup edit');
        $entity->setGroupRolTag('group-templatesetupedit');
        $manager->persist($entity);
        $this->addReference('role-delete-templatesetupedit', $entity);

        $entity = new Role();
        $entity->setName('view');
        $entity->setSlug('ROLE_TEMPLATESETUPEDIT_VIEW');
        $entity->setGroupRol('templ setup edit');
        $entity->setGroupRolTag('group-templatesetupedit');
        $manager->persist($entity);
        $this->addReference('role-view-templatesetupedit', $entity);

        $entity = new Role();
        $entity->setName('dummy');
        $entity->setSlug('ROLE_DUMMY');
        $entity->setGroupRol('templ setupedit');
        $entity->setGroupRolTag('group-templatesetupedit');
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