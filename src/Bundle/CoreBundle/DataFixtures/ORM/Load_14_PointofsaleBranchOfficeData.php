<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_14_PointofsaleBranchOfficeData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $pointOfSale = $this->getReference('pointofsale-10');

        $entity = new Pointofsale();
        $entity->setCode('1111');
        $entity->setName('Salon Belleza Sucursal 1');
        $entity->setAddress('Av. paz 234');
        $entity->setPhone('994826014');
        $entity->setSlug('point-of-sale-11');
        $entity->setLatitude('-12.0240716');
        $entity->setLongitude('-77.1120326');
	    $entity->setPointOfSale($pointOfSale);
        $manager->persist($entity);
        $this->addReference('pointofsale-11', $entity);

        $entity = new Pointofsale();
        $entity->setCode('2222');
        $entity->setName('Salon Belleza Sucursal 2');
        $entity->setAddress('Av. paz 234');
        $entity->setPhone('2484434');
        $entity->setSlug('point-of-sale-12');
        $entity->setLatitude('-12.1476123');
        $entity->setLongitude('-77.021375');
	    $entity->setPointOfSale($pointOfSale);
        $manager->persist($entity);
        $this->addReference('pointofsale-12', $entity);

        $entity = new Pointofsale();
        $entity->setCode('3333');
        $entity->setName('Salon Belleza Sucursal 3');
        $entity->setAddress('Av. paz 234');
        $entity->setPhone('998461653');
        $entity->setSlug('point-of-sale-13');
        $entity->setLatitude('-12.0982821');
        $entity->setLongitude('-76.9620132');
	    $entity->setPointOfSale($pointOfSale);
        $manager->persist($entity);
        $this->addReference('pointofsale-13', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 14;
    }
}