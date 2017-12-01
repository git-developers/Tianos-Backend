<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Template;

class Load_5_TemplateData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new Template();
        $entity->setCode('1');
        $entity->setName('Template uno');
        $manager->persist($entity);

        $entity = new Template();
        $entity->setCode('2');
        $entity->setName('Template dos');
        $manager->persist($entity);

        $entity = new Template();
        $entity->setCode('3');
        $entity->setName('Template tres');
        $entity->setIsActiveTemplate(1);
        $manager->persist($entity);

        $this->addReference('template', $entity);

        $entity = new Template();
        $entity->setCode('4');
        $entity->setName('Template cuatro');
        $manager->persist($entity);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 8;
    }
}