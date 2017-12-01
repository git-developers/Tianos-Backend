<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\Category;

class Load_2_CategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * PARENT
         */
        $parent_1 = new Category();
        $parent_1->setCode('22');
        $parent_1->setName('Category 2');
        $parent_1->setIsActive(true);
        $manager->persist($parent_1);


        $parent_2 = new Category();
        $parent_2->setCode('33');
        $parent_2->setName('Category 3');
        $parent_2->setIsActive(true);
        $manager->persist($parent_2);

        $parent_3 = new Category();
        $parent_3->setCode('44');
        $parent_3->setName('Category 4');
        $parent_3->setIsActive(true);
        $manager->persist($parent_3);


        /**
         * CHILDREN
         */
        $entity = new Category();
        $entity->setCategory($parent_3);
        $entity->setCode('88');
        $entity->setName('Category 8');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCategory($parent_2);
        $entity->setCode('77');
        $entity->setName('Category 8');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity_6 = new Category();
        $entity_6->setCategory($parent_2);
        $entity_6->setCode('66');
        $entity_6->setName('Category 8');
        $entity_6->setIsActive(true);
        $manager->persist($entity_6);

        $entity = new Category();
        $entity->setCategory($parent_2);
        $entity->setCode('55');
        $entity->setName('Category 5');
        $entity->setIsActive(true);
        $manager->persist($entity);



//        children 9 - 10
        $entity = new Category();
        $entity->setCategory($entity_6);
        $entity->setCode('99');
        $entity->setName('Category 9');
        $entity->setIsActive(true);
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCategory($entity_6);
        $entity->setCode('1010');
        $entity->setName('Category 10');
        $entity->setIsActive(true);
        $manager->persist($entity);



        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}