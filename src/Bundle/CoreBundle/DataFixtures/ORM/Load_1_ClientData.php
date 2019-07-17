<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ClientBundle\Entity\Client;

class Load_1_ClientData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        $entity = new Client();
        $entity->setCode('111');
        $entity->setName('Planta norte chiclayo');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new Client();
        $entity->setCode('222');
        $entity->setName('Planta centro Huancayo');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new Client();
        $entity->setCode('333');
        $entity->setName('Planta centro Pando');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('cliente-planta-centro-pando', $entity);

        $entity = new Client();
        $entity->setCode('444');
        $entity->setName('Planta sur Arequipa');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}