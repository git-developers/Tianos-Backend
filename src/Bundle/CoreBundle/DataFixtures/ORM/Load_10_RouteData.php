<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\RouteBundle\Entity\Route;

class Load_10_RouteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        $pointofsale_1 = $this->getReference('pointofsale-1');
        $pointofsale_2 = $this->getReference('pointofsale-2');
        $pointofsale_3 = $this->getReference('pointofsale-3');
        $pointofsale_4 = $this->getReference('pointofsale-4');
        $pointofsale_5 = $this->getReference('pointofsale-5');
        $pointofsale_6 = $this->getReference('pointofsale-6');
        $pointofsale_7 = $this->getReference('pointofsale-7');
        $pointofsale_8 = $this->getReference('pointofsale-8');
        $pointofsale_9 = $this->getReference('pointofsale-9');
        $pointofsale_10 = $this->getReference('pointofsale-10');
        $pointofsale_11 = $this->getReference('pointofsale-11');
        $pointofsale_12 = $this->getReference('pointofsale-12');
        $pointofsale_13 = $this->getReference('pointofsale-13');
        $pointofsale_14 = $this->getReference('pointofsale-14');
        $pointofsale_15 = $this->getReference('pointofsale-15');
        $pointofsale_16 = $this->getReference('pointofsale-16');
        $pointofsale_17 = $this->getReference('pointofsale-17');
        $pointofsale_18 = $this->getReference('pointofsale-18');
        $pointofsale_19 = $this->getReference('pointofsale-19');
        $pointofsale_20 = $this->getReference('pointofsale-20');

        $entity = new Route();
        $entity->setCode('111');
        $entity->setName('Ruta centro');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_1);
        $entity->addPointOfSale($pointofsale_2);
        $entity->addPointOfSale($pointofsale_3);
        $manager->persist($entity);
        $this->addReference('route-1', $entity);

        $entity = new Route();
        $entity->setCode('222');
        $entity->setName('Ruta sur');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_4);
        $entity->addPointOfSale($pointofsale_5);
        $entity->addPointOfSale($pointofsale_6);
        $manager->persist($entity);
        $this->addReference('route-2', $entity);

        $entity = new Route();
        $entity->setCode('333');
        $entity->setName('Ruta norte');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_7);
        $entity->addPointOfSale($pointofsale_8);
        $entity->addPointOfSale($pointofsale_9);
        $manager->persist($entity);
        $this->addReference('route-3', $entity);

        $entity = new Route();
        $entity->setCode('444');
        $entity->setName('Ruta central 4');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_10);
        $entity->addPointOfSale($pointofsale_11);
        $entity->addPointOfSale($pointofsale_12);
        $manager->persist($entity);
        $this->addReference('route-4', $entity);

        $entity = new Route();
        $entity->setCode('555');
        $entity->setName('Ruta  central 5');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_13);
        $entity->addPointOfSale($pointofsale_14);
        $manager->persist($entity);
        $this->addReference('route-5', $entity);

        $entity = new Route();
        $entity->setCode('666');
        $entity->setName('Ruta  central 6');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_15);
        $entity->addPointOfSale($pointofsale_16);
        $manager->persist($entity);
        $this->addReference('route-6', $entity);

        $entity = new Route();
        $entity->setCode('777');
        $entity->setName('Ruta  central 7');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_17);
        $entity->addPointOfSale($pointofsale_18);
        $manager->persist($entity);
        $this->addReference('route-7', $entity);

        $entity = new Route();
        $entity->setCode('888');
        $entity->setName('Ruta  central 8');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addPointOfSale($pointofsale_19);
        $entity->addPointOfSale($pointofsale_20);
        $manager->persist($entity);
        $this->addReference('route-8', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 10;
    }
}