<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ModuleBundle\Entity\Module;

class Load_13_ModuleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $user_1 = $this->getReference('user-1');

        $entity = new Module();
        $entity->setCode('001');
        $entity->setName(Module::APPOINTMENT_BOOK);
        $manager->persist($entity);
        $this->addReference('module-1', $entity);

        $entity = new Module();
        $entity->setCode('002');
        $entity->setName(Module::INVENTORY);
        $manager->persist($entity);
        $this->addReference('module-2', $entity);

        $entity = new Module();
        $entity->setCode('003');
        $entity->setName(Module::USERS_MANAGEMENT);
        $manager->persist($entity);
        $this->addReference('module-3', $entity);

        $entity = new Module();
        $entity->setCode('005');
        $entity->setName(Module::REPORTS);
        $manager->persist($entity);
        $this->addReference('module-5', $entity);

        $entity = new Module();
        $entity->setCode('006');
        $entity->setName(Module::SERVICE);
        $manager->persist($entity);
        $this->addReference('module-6', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 13;
    }
}