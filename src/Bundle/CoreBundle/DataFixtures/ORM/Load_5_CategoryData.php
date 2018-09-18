<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\CategoryBundle\Entity\Category;

class Load_5_CategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $entity = new Category();
        $entity->setCode('cat-111');
        $entity->setName('Categoria 111');
//        $entity->setSlug('marca-prensmart');
        $manager->persist($entity);
        $this->addReference('category-1', $entity);

        $entity = new Category();
        $entity->setCode('cat-222');
        $entity->setName('Categoria 222');
//        $entity->setSlug('marca-el-comercio');
        $manager->persist($entity);
        $this->addReference('category-2', $entity);


        /*
        $entity = new Category();
        $entity->setCode('111');
        $entity->setName('Periódicos');
        $entity->setSlug('category-1');
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCode('222');
        $entity->setName('Revistas');
        $entity->setSlug('category-2');
        $manager->persist($entity);

        $category = new Category();
        $category->setCode('333');
        $category->setName('Brochures');
        $category->setSlug('category-3');
        $manager->persist($category);

        $entity = new Category();
        $entity->setCode('333-1');
        $entity->setName('Category 3-1');
        $entity->setSlug('category-3-1');
        $entity->setCategory($category);
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCode('333-2');
        $entity->setName('Category 3-2');
        $entity->setSlug('category-3-2');
        $entity->setCategory($category);
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCode('333-3');
        $entity->setName('Category 3-3');
        $entity->setSlug('category-3-3');
        $entity->setCategory($category);
        $manager->persist($entity);

        $entity = new Category();
        $entity->setCode('444');
        $entity->setName('Publicidad');
        $entity->setSlug('category-4');
        $manager->persist($entity);
        */


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }
}