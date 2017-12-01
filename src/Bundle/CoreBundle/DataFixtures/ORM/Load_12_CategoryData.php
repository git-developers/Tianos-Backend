<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\TemplateECategory;

class Load_10_CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * PARENT
         */
        $parent_1 = new TemplateECategory();
        $parent_1->setCode('11');
        $parent_1->setName('Template category 1');
        $parent_1->setIsActive(true);
        $manager->persist($parent_1);

        $parent_2 = new TemplateECategory();
        $parent_2->setCode('22');
        $parent_2->setName('Template category 2');
        $parent_2->setIsActive(true);
        $manager->persist($parent_2);

        $parent_3 = new TemplateECategory();
        $parent_3->setCode('33');
        $parent_3->setName('Template category 3');
        $parent_3->setIsActive(true);
        $manager->persist($parent_3);

        $parent_4 = new TemplateECategory();
        $parent_4->setCode('44');
        $parent_4->setName('Template category 4');
        $parent_4->setIsActive(true);
        $manager->persist($parent_4);



        /**
         * CHILDREN PARENT 3
         */
        $entity = new TemplateECategory();
        $entity->setTemplateECategory($parent_3);
        $entity->setCode('55');
        $entity->setName('Template category 5');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new TemplateECategory();
        $entity->setTemplateECategory($parent_3);
        $entity->setCode('66');
        $entity->setName('Template category 6');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new TemplateECategory();
        $entity->setTemplateECategory($parent_3);
        $entity->setCode('77');
        $entity->setName('Template category 7');
        $entity->setIsActive(true);
        $manager->persist($entity);



        /**
         * CHILDREN PARENT 4
         */
        $entity = new TemplateECategory();
        $entity->setTemplateECategory($parent_4);
        $entity->setCode('88');
        $entity->setName('Template category 8');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $parent_9 = new TemplateECategory();
        $parent_9->setTemplateECategory($parent_4);
        $parent_9->setCode('99');
        $parent_9->setName('Template category 9');
        $parent_9->setIsActive(true);
        $manager->persist($parent_9);


        /**
         * CHILDREN PARENT 9
         */
        $entity = new TemplateECategory();
        $entity->setTemplateECategory($parent_9);
        $entity->setCode('1010');
        $entity->setName('Template category 10');
        $entity->setIsActive(true);
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 12;
    }
}