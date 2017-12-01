<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Profile;

class Load_12_ProfileData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $roleCreateUser = $this->getReference('role-create-user');
        $roleEditUser = $this->getReference('role-edit-user');
        $roleDeleteUser = $this->getReference('role-delete-user');
        $roleViewUser = $this->getReference('role-view-user');
        $roleChangepasswordUser = $this->getReference('role-changepassword-user');

        $roleCreatePointofsale = $this->getReference('role-create-pointofsale');
        $roleEditPointofsale = $this->getReference('role-edit-pointofsale');
        $roleDeletePointofsale = $this->getReference('role-delete-pointofsale');
        $roleViewPointofsale = $this->getReference('role-view-pointofsale');

        $roleCreatePointofsaleTree = $this->getReference('role-create-pointofsaletree');
        $roleCreateChildPointofsaleTree = $this->getReference('role-createchild-pointofsaletree');
        $roleEditPointofsaleTree = $this->getReference('role-edit-pointofsaletree');
        $roleDeletePointofsaleTree = $this->getReference('role-delete-pointofsaletree');
        $roleViewPointofsaleTree = $this->getReference('role-view-pointofsaletree');

        $roleCreateAclrole = $this->getReference('role-create-aclrole');
        $roleEditAclrole = $this->getReference('role-edit-aclrole');
        $roleDeleteAclrole = $this->getReference('role-delete-aclrole');
        $roleViewAclrole = $this->getReference('role-view-aclrole');

        $roleCreateAclprofile = $this->getReference('role-create-aclprofile');
        $roleEditAclprofile = $this->getReference('role-edit-aclprofile');
        $roleDeleteAclprofile = $this->getReference('role-delete-aclprofile');
        $roleViewAclprofile = $this->getReference('role-view-aclprofile');

        $roleCreateCategorytree = $this->getReference('role-create-categorytree');
        $roleCreateChildCategorytree = $this->getReference('role-createchild-categorytree');
        $roleEditCategorytree = $this->getReference('role-edit-categorytree');
        $roleDeleteCategorytree = $this->getReference('role-delete-categorytree');
        $roleViewCategorytree = $this->getReference('role-view-categorytree');

        $roleCreateGroupofusers = $this->getReference('role-create-groupofusers');
        $roleEditGroupofusers = $this->getReference('role-edit-groupofusers');
        $roleDeleteGroupofusers = $this->getReference('role-delete-groupofusers');
        $roleViewGroupofusers = $this->getReference('role-view-groupofusers');

        $roleCreateTemplate = $this->getReference('role-create-template');
        $roleEditTemplate = $this->getReference('role-edit-template');
        $roleDeleteTemplate = $this->getReference('role-delete-template');
        $roleViewTemplate = $this->getReference('role-view-template');

        $roleCreateTemplatemodule = $this->getReference('role-create-templatemodule');
        $roleEditTemplatemodule = $this->getReference('role-edit-templatemodule');
        $roleDeleteTemplatemodule = $this->getReference('role-delete-templatemodule');
        $roleViewTemplatemodule = $this->getReference('role-view-templatemodule');

        $roleCreateTemplateecategory = $this->getReference('role-create-templateecategory');
        $roleEditTemplateecategory = $this->getReference('role-edit-templateecategory');
        $roleDeleteTemplateecategory = $this->getReference('role-delete-templateecategory');
        $roleViewTemplateecategory = $this->getReference('role-view-templateecategory');

        $roleCreateTemplatesetupedit = $this->getReference('role-create-templatesetupedit');
        $roleEditTemplatesetupedit = $this->getReference('role-edit-templatesetupedit');
        $roleDeleteTemplatesetupedit = $this->getReference('role-delete-templatesetupedit');
        $roleViewTemplatesetupedit = $this->getReference('role-view-templatesetupedit');

        $roleAssignCategorytreetoassign = $this->getReference('role-assign-categorytreetoassign');
        $roleCreateCategorytreetoassign = $this->getReference('role-create-categorytreetoassign');
        $roleCreatechildCategorytreetoassign = $this->getReference('role-createchild-categorytreetoassign');
        $roleEditCategorytreetoassign = $this->getReference('role-edit-categorytreetoassign');
        $roleDeleteCategorytreetoassign = $this->getReference('role-delete-categorytreetoassign');
        $roleViewCategorytreetoassign = $this->getReference('role-view-categorytreetoassign');

        $roleTemplatesetup = $this->getReference('role-templatesetup');

        $roleViewAssignpointofsalehasproduct = $this->getReference('role-view-assignpointofsalehasproduct');
        $roleAssignAssignpointofsalehasproduct = $this->getReference('role-assign-assignpointofsalehasproduct');

        $roleViewAssignuserhaspointofsale = $this->getReference('role-view-assignuserhaspointofsale');
        $roleAssignAssignuserhaspointofsale = $this->getReference('role-assign-assignuserhaspointofsale');

        $roleViewAssigngrouphasuser = $this->getReference('role-view-assigngrouphasuser');
        $roleAssignAssigngrouphasuser = $this->getReference('role-assign-assigngrouphasuser');

        $roleViewAssigntemplatehasmodule = $this->getReference('role-view-assigntemplatehasmodule');
        $roleAssignAssigntemplatehasmodule = $this->getReference('role-assign-assigntemplatehasmodule');

        $roleBackend = $this->getReference('role-backend');


        $entity = new Profile();
        $entity->setName(Profile::ADMIN);

        $entity->addRole($roleBackend);

        $entity->addRole($roleViewAssigntemplatehasmodule);
        $entity->addRole($roleAssignAssigntemplatehasmodule);

        $entity->addRole($roleViewAssigngrouphasuser);
        $entity->addRole($roleAssignAssigngrouphasuser);

        $entity->addRole($roleViewAssignuserhaspointofsale);
        $entity->addRole($roleAssignAssignuserhaspointofsale);

        $entity->addRole($roleViewAssignpointofsalehasproduct);
        $entity->addRole($roleAssignAssignpointofsalehasproduct);

        $entity->addRole($roleTemplatesetup);

        $entity->addRole($roleAssignCategorytreetoassign);
        $entity->addRole($roleCreateCategorytreetoassign);
        $entity->addRole($roleCreatechildCategorytreetoassign);
        $entity->addRole($roleEditCategorytreetoassign);
        $entity->addRole($roleDeleteCategorytreetoassign);
        $entity->addRole($roleViewCategorytreetoassign);

        $entity->addRole($roleCreateUser);
        $entity->addRole($roleEditUser);
        $entity->addRole($roleDeleteUser);
        $entity->addRole($roleViewUser);
        $entity->addRole($roleChangepasswordUser);

        $entity->addRole($roleCreatePointofsale);
        $entity->addRole($roleEditPointofsale);
        $entity->addRole($roleDeletePointofsale);
        $entity->addRole($roleViewPointofsale);

        $entity->addRole($roleCreatePointofsaleTree);
        $entity->addRole($roleCreateChildPointofsaleTree);
        $entity->addRole($roleEditPointofsaleTree);
        $entity->addRole($roleDeletePointofsaleTree);
        $entity->addRole($roleViewPointofsaleTree);

        $entity->addRole($roleCreateAclrole);
        $entity->addRole($roleEditAclrole);
        $entity->addRole($roleDeleteAclrole);
        $entity->addRole($roleViewAclrole);

        $entity->addRole($roleCreateAclprofile);
        $entity->addRole($roleEditAclprofile);
        $entity->addRole($roleDeleteAclprofile);
        $entity->addRole($roleViewAclprofile);

        $entity->addRole($roleCreateCategorytree);
        $entity->addRole($roleCreateChildCategorytree);
        $entity->addRole($roleEditCategorytree);
        $entity->addRole($roleDeleteCategorytree);
        $entity->addRole($roleViewCategorytree);

        $entity->addRole($roleCreateGroupofusers);
        $entity->addRole($roleEditGroupofusers);
        $entity->addRole($roleDeleteGroupofusers);
        $entity->addRole($roleViewGroupofusers);

        $entity->addRole($roleCreateTemplate);
        $entity->addRole($roleEditTemplate);
        $entity->addRole($roleDeleteTemplate);
        $entity->addRole($roleViewTemplate);

        $entity->addRole($roleCreateTemplatemodule);
        $entity->addRole($roleEditTemplatemodule);
        $entity->addRole($roleDeleteTemplatemodule);
        $entity->addRole($roleViewTemplatemodule);

        $entity->addRole($roleCreateTemplateecategory);
        $entity->addRole($roleEditTemplateecategory);
        $entity->addRole($roleDeleteTemplateecategory);
        $entity->addRole($roleViewTemplateecategory);

        $entity->addRole($roleCreateTemplatesetupedit);
        $entity->addRole($roleEditTemplatesetupedit);
        $entity->addRole($roleDeleteTemplatesetupedit);
        $entity->addRole($roleViewTemplatesetupedit);

        $manager->persist($entity);
        $this->addReference('profile-editor', $entity);


        $entity = new Profile();
        $entity->setName('Conductor');
        $manager->persist($entity);

        $entity = new Profile();
        $entity->setName('Despachador');
        $manager->persist($entity);

        $entity = new Profile();
        $entity->setName(Profile::GUEST);
        $entity->addRole($roleBackend);
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}