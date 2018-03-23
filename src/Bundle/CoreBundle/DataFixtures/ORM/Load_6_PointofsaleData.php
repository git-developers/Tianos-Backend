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
        $entity->setName('Aeropuerto');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0712498');
        $entity->setLongitude('-77.0770748');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('222');
        $entity->setName('Barranco');
        $entity->setSlug('point-of-sale-2');
        $entity->setLatitude('12.1206817');
        $entity->setLongitude('-77.0292692');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('333');
        $entity->setName('Chorrillos');
        $entity->setSlug('point-of-sale-3');
        $entity->setLatitude('-12.1120513');
        $entity->setLongitude('-77.0117946');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('444');
        $entity->setName('El Porvenir');
        $entity->setSlug('point-of-sale-4');
        $entity->setLatitude('-12.0672672');
        $entity->setLongitude('-77.0335231');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('555');
        $entity->setName('La Molina');
        $entity->setSlug('point-of-sale-5');
        $entity->setLatitude('-12.0732906');
        $entity->setLongitude('-77.1677068');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('666');
        $entity->setName('Lurigancho');
        $entity->setSlug('point-of-sale-6');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('777');
        $entity->setName('Magdalena');
        $entity->setSlug('point-of-sale-7');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('888');
        $entity->setName('Miraflores');
        $entity->setSlug('point-of-sale-8');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('999');
        $entity->setName('Plaza Grau');
        $entity->setSlug('point-of-sale-9');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1010');
        $entity->setName('Puente Piedra II');
        $entity->setSlug('point-of-sale-10');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1111');
        $entity->setName('Salamanca');
        $entity->setSlug('point-of-sale-11');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1212');
        $entity->setName('San Borja');
        $entity->setSlug('point-of-sale-12');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1313');
        $entity->setName('San Martin De Porres');
        $entity->setSlug('point-of-sale-13');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1414');
        $entity->setName('Surquillo');
        $entity->setSlug('point-of-sale-14');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1515');
        $entity->setName('Ventanilla II');
        $entity->setSlug('point-of-sale-15');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1616');
        $entity->setName('Zarumilla');
        $entity->setSlug('point-of-sale-16');
        $entity->setLatitude('-12.0241618');
        $entity->setLongitude('-77.1118886');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1717');
        $entity->setName('Tomas Marsano');
        $entity->setSlug('point-of-sale-17');
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