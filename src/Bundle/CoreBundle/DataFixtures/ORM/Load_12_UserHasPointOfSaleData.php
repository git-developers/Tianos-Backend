<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_12_UserHasPointOfSaleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $distribuidor_1 = $this->getReference('distribuidor-1');
        $distribuidor_2 = $this->getReference('distribuidor-2');
        $distribuidor_3 = $this->getReference('distribuidor-3');
        $distribuidor_4 = $this->getReference('distribuidor-4');
        $distribuidor_5 = $this->getReference('distribuidor-5');

        $pointofsale_1 = $this->getReference('pointofsale-1');
        $pointofsale_2 = $this->getReference('pointofsale-2');
        $pointofsale_3 = $this->getReference('pointofsale-3');
        $pointofsale_4 = $this->getReference('pointofsale-4');
        $pointofsale_5 = $this->getReference('pointofsale-5');


        $distribuidor_1->addPointOfSale($pointofsale_1);
        $manager->persist($distribuidor_1);

        $distribuidor_2->addPointOfSale($pointofsale_2);
        $manager->persist($distribuidor_2);

        $distribuidor_3->addPointOfSale($pointofsale_3);
        $manager->persist($distribuidor_3);

        $distribuidor_4->addPointOfSale($pointofsale_4);
        $manager->persist($distribuidor_4);

        $distribuidor_5->addPointOfSale($pointofsale_5);
        $manager->persist($distribuidor_5);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 12;
    }
}