<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\CategoryBundle\Entity\CategoryHasProduct;

class Load_7_CategoryHasProductData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        $categoryPrensmart = $this->getReference('category-prensmart');
        $categoryElcomercio = $this->getReference('category-elcomercio');

        $productPrensmart1 = $this->getReference('product-prensmart-1');
        $productPrensmart2 = $this->getReference('product-prensmart-2');
        $productPrensmart3 = $this->getReference('product-prensmart-3');

        $productElcomercio4 = $this->getReference('product-elcomercio-4');
        $productElcomercio5 = $this->getReference('product-elcomercio-5');
        $productElcomercio6 = $this->getReference('product-elcomercio-6');
        $productElcomercio7 = $this->getReference('product-elcomercio-7');
        $productElcomercio8 = $this->getReference('product-elcomercio-8');




        /**
         * Marca PrenSmart
         */
        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryPrensmart);
        $entity->setProduct($productPrensmart1);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryPrensmart);
        $entity->setProduct($productPrensmart2);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryPrensmart);
        $entity->setProduct($productPrensmart3);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);



        /**
         * Marca El Comercio
         */
        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryElcomercio);
        $entity->setProduct($productElcomercio4);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryElcomercio);
        $entity->setProduct($productElcomercio5);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryElcomercio);
        $entity->setProduct($productElcomercio6);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryElcomercio);
        $entity->setProduct($productElcomercio7);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new CategoryHasProduct();
        $entity->setCategory($categoryElcomercio);
        $entity->setProduct($productElcomercio8);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 7;
    }
}