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
        $distribuidor_6 = $this->getReference('distribuidor-6');
        $distribuidor_7 = $this->getReference('distribuidor-7');
        $distribuidor_8 = $this->getReference('distribuidor-8');
        $distribuidor_9 = $this->getReference('distribuidor-9');
        $distribuidor_10 = $this->getReference('distribuidor-10');
        $distribuidor_11 = $this->getReference('distribuidor-11');
        $distribuidor_12 = $this->getReference('distribuidor-12');
        $distribuidor_13 = $this->getReference('distribuidor-13');
        $distribuidor_14 = $this->getReference('distribuidor-14');
        $distribuidor_15 = $this->getReference('distribuidor-15');
        $distribuidor_16 = $this->getReference('distribuidor-16');
        $distribuidor_17 = $this->getReference('distribuidor-17');
        $distribuidor_18 = $this->getReference('distribuidor-18');
        $distribuidor_19 = $this->getReference('distribuidor-19');
        $distribuidor_20 = $this->getReference('distribuidor-20');

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

        $distribuidor_6->addPointOfSale($pointofsale_6);
        $manager->persist($distribuidor_6);

        $distribuidor_7->addPointOfSale($pointofsale_7);
        $manager->persist($distribuidor_7);

        $distribuidor_8->addPointOfSale($pointofsale_8);
        $manager->persist($distribuidor_8);

        $distribuidor_9->addPointOfSale($pointofsale_9);
        $manager->persist($distribuidor_9);

        $distribuidor_10->addPointOfSale($pointofsale_10);
        $manager->persist($distribuidor_10);

        $distribuidor_11->addPointOfSale($pointofsale_11);
        $manager->persist($distribuidor_11);

        $distribuidor_12->addPointOfSale($pointofsale_12);
        $manager->persist($distribuidor_12);

        $distribuidor_13->addPointOfSale($pointofsale_13);
        $manager->persist($distribuidor_13);

        $distribuidor_14->addPointOfSale($pointofsale_14);
        $manager->persist($distribuidor_14);

        $distribuidor_15->addPointOfSale($pointofsale_15);
        $manager->persist($distribuidor_15);

        $distribuidor_16->addPointOfSale($pointofsale_16);
        $manager->persist($distribuidor_16);

        $distribuidor_17->addPointOfSale($pointofsale_17);
        $manager->persist($distribuidor_17);

        $distribuidor_18->addPointOfSale($pointofsale_18);
        $manager->persist($distribuidor_18);

        $distribuidor_19->addPointOfSale($pointofsale_19);
        $manager->persist($distribuidor_19);

        $distribuidor_20->addPointOfSale($pointofsale_20);
        $manager->persist($distribuidor_20);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 12;
    }
}