<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ProductBundle\Entity\Product;

class Load_6_ProductData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        /**
         * Marca PrenSmart
         */
        $entity = new Product();
        $entity->setCode('111');
        $entity->setName('Ojo');
        $entity->setSlug('product-1');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-prensmart-1', $entity);

        $entity = new Product();
        $entity->setCode('222');
        $entity->setName('El Bocón');
        $entity->setSlug('product-2');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-prensmart-2', $entity);

        $entity = new Product();
        $entity->setCode('333');
        $entity->setName('Correo');
        $entity->setSlug('product-3');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-prensmart-3', $entity);




        /**
         * Marca El Comercio
         */
        $entity = new Product();
        $entity->setCode('444');
        $entity->setName('El Comercio');
        $entity->setSlug('product-4');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-elcomercio-4', $entity);

        $entity = new Product();
        $entity->setCode('555');
        $entity->setName('Gestión');
        $entity->setSlug('product-5');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-elcomercio-5', $entity);

        $entity = new Product();
        $entity->setCode('666');
        $entity->setName('Trome');
        $entity->setSlug('product-6');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-elcomercio-6', $entity);

        $entity = new Product();
        $entity->setCode('777');
        $entity->setName('Perú 21');
        $entity->setSlug('product-7');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-elcomercio-7', $entity);

        $entity = new Product();
        $entity->setCode('888');
        $entity->setName('Depor');
        $entity->setSlug('product-8');
        $entity->setImage('http://www.free-icons-download.net/images/product-icon-27962.png');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('product-elcomercio-8', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}