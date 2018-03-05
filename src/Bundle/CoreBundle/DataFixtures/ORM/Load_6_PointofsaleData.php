<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_6_PointofsaleData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $entity = new Pointofsale();
        $entity->setCode('111');
        $entity->setName('Imprenta diario el comercio');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0712498');
        $entity->setLongitude('-77.0770748');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('222');
        $entity->setName('Point of sale 2');
        $entity->setSlug('point-of-sale-2');
        $entity->setLatitude('12.1206817');
        $entity->setLongitude('-77.0292692');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('333');
        $entity->setName('Point of sale 3');
        $entity->setSlug('point-of-sale-3');
        $entity->setLatitude('-12.1120513');
        $entity->setLongitude('-77.0117946');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('444');
        $entity->setName('Point of sale 4');
        $entity->setSlug('point-of-sale-4');
        $entity->setLatitude('-12.0672672');
        $entity->setLongitude('-77.0335231');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('555');
        $entity->setName('Point of sale 5');
        $entity->setSlug('point-of-sale-5');
        $entity->setLatitude('-12.0732906');
        $entity->setLongitude('-77.1677068');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('666');
        $entity->setName('Point of sale 6');
        $entity->setSlug('point-of-sale-6');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 6;
    }
}