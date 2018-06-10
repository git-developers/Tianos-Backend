<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\RouteBundle\Entity\Route;

class Load_9_RouteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $entity = new Route();
        $entity->setCode('111');
        $entity->setName('Ruta centro');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('222');
        $entity->setName('Ruta sur');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('333');
        $entity->setName('Ruta norte');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('444');
        $entity->setName('Ruta central 4');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('555');
        $entity->setName('Ruta  central 5');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('666');
        $entity->setName('Ruta  central 6');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('777');
        $entity->setName('Ruta  central 7');
        $manager->persist($entity);

        $entity = new Route();
        $entity->setCode('888');
        $entity->setName('Ruta  central 8');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }
}