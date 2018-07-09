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
        $roleAdmin = $this->getReference('role-admin');
        $roleRegularUser = $this->getReference('role-regular-user');
        $roleGuest = $this->getReference('role-guest');

        $roleUserCreate = $this->getReference('role-user-create');
        $roleUserEdit = $this->getReference('role-user-edit');
        $roleUserView = $this->getReference('role-user-view');
        $roleUserDelete = $this->getReference('role-user-delete');


        $entity = new Profile();
        $entity->setName(Profile::ADMIN);
        $entity->addRole($roleAdmin);
        $entity->addRole($roleUserCreate);
        $entity->addRole($roleUserEdit);
        $entity->addRole($roleUserView);
        $entity->addRole($roleUserDelete);
        $manager->persist($entity);
        $this->addReference('profile-admin', $entity);


        $entity = new Profile();
        $entity->setName(Profile::REGULAR_USER);
        $entity->addRole($roleRegularUser);
        $manager->persist($entity);
        $this->addReference('profile-regular-user', $entity);


        $entity = new Profile();
        $entity->setName(Profile::GUEST);
        $entity->addRole($roleGuest);
        $manager->persist($entity);
        $this->addReference('profile-guest', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}