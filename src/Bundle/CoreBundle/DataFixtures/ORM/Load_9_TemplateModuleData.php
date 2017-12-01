<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\TemplateModule;

class Load_6_TemplateModuleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new TemplateModule();
        $entity->setModuleOrder(1);
        $entity->setType(TemplateModule::INDEX);
        $manager->persist($entity);
        $this->addReference('module-index', $entity);

        $entity = new TemplateModule();
        $entity->setModuleOrder(2);
        $entity->setType(TemplateModule::PARAGRAPH);
        $manager->persist($entity);
        $this->addReference('module-paragraph', $entity);

        $entity = new TemplateModule();
        $entity->setModuleOrder(3);
        $entity->setType(TemplateModule::BLOG);
        $manager->persist($entity);
        $this->addReference('module-blog', $entity);

        $entity = new TemplateModule();
        $entity->setModuleOrder(4);
        $entity->setType(TemplateModule::BLOG_POST);
        $manager->persist($entity);
        $this->addReference('module-blog-post', $entity);

        $entity = new TemplateModule();
        $entity->setModuleOrder(5);
        $entity->setType(TemplateModule::ITEM);
        $manager->persist($entity);
        $this->addReference('module-item', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }
}