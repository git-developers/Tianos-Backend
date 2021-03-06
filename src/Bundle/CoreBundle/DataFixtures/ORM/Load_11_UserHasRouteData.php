<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_11_UserHasRouteData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $transportista_1 = $this->getReference('transportista-1');
        $transportista_2 = $this->getReference('transportista-2');
        $transportista_3 = $this->getReference('transportista-3');
        $transportista_4 = $this->getReference('transportista-4');
        $transportista_5 = $this->getReference('transportista-5');
        $transportista_6 = $this->getReference('transportista-6');
        $transportista_7 = $this->getReference('transportista-7');
        $transportista_8 = $this->getReference('transportista-8');

        $route_1 = $this->getReference('route-1');
        $route_2 = $this->getReference('route-2');
        $route_3 = $this->getReference('route-3');
        $route_4 = $this->getReference('route-4');
        $route_5 = $this->getReference('route-5');
        $route_6 = $this->getReference('route-6');
        $route_7 = $this->getReference('route-7');
        $route_8 = $this->getReference('route-8');


        $transportista_1->addRoute($route_1);
        $manager->persist($transportista_1);

        $transportista_2->addRoute($route_2);
        $manager->persist($transportista_2);

        $transportista_3->addRoute($route_3);
        $manager->persist($transportista_3);

        $transportista_4->addRoute($route_4);
        $manager->persist($transportista_4);

        $transportista_5->addRoute($route_5);
        $manager->persist($transportista_5);

        $transportista_6->addRoute($route_6);
        $manager->persist($transportista_6);

        $transportista_7->addRoute($route_7);
        $manager->persist($transportista_7);

        $transportista_8->addRoute($route_8);
        $manager->persist($transportista_8);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 11;
    }
}