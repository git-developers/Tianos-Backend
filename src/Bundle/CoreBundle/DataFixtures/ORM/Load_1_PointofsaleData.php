<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_1_PointofsaleData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

//        $canillita_1 = $this->getReference('canillita-1');


        $entity = new Pointofsale();
        $entity->setCode('111');
        $entity->setName('Aeropuerto');
        $entity->setAddress('Av. Tomas Valle Mz.g 37 Lt.31 Aa.hh Bocanegra Callao');
        $entity->setPhone('994826014');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0240716');
        $entity->setLongitude('-77.1120326');
        $manager->persist($entity);
        $this->addReference('pointofsale-1', $entity);

        $entity = new Pointofsale();
        $entity->setCode('222');
        $entity->setName('Barranco');
        $entity->setAddress('Calle Union 208, Barranco');
        $entity->setPhone('2484434');
        $entity->setSlug('point-of-sale-2');
        $entity->setLatitude('-12.1476123');
        $entity->setLongitude('-77.021375');
        $manager->persist($entity);
        $this->addReference('pointofsale-2', $entity);

        $entity = new Pointofsale();
        $entity->setCode('333');
        $entity->setName('Chorrillos');
        $entity->setAddress('Jr. Delfín Puccio Mz.a Lt.8 Urb.san Juan, Chorrillos');
        $entity->setPhone('998461653');
        $entity->setSlug('point-of-sale-3');
        $entity->setLatitude('-12.0982821');
        $entity->setLongitude('-76.9620132');
        $manager->persist($entity);
        $this->addReference('pointofsale-3', $entity);

        $entity = new Pointofsale();
        $entity->setCode('444');
        $entity->setName('El Porvenir');
        $entity->setAddress('Jr. Garibaldi 367, La Victoria');
        $entity->setPhone('5731246');
        $entity->setSlug('point-of-sale-4');
        $entity->setLatitude('-12.0625411');
        $entity->setLongitude('-77.0167905');
        $manager->persist($entity);
        $this->addReference('pointofsale-4', $entity);

        $entity = new Pointofsale();
        $entity->setCode('555');
        $entity->setName('La Molina');
        $entity->setAddress('Av. La Molina 740');
        $entity->setPhone('999040550');
        $entity->setSlug('point-of-sale-5');
        $entity->setLatitude('-12.0660291');
        $entity->setLongitude('-76.959109');
        $manager->persist($entity);
        $this->addReference('pointofsale-5', $entity);

        $entity = new Pointofsale();
        $entity->setCode('666');
        $entity->setName('Lurigancho');
        $entity->setAddress('Av. Gran Chimu 1era Crda Zarate, Lurigancho (Porton Plomo)');
        $entity->setPhone('999339483');
        $entity->setSlug('point-of-sale-6');
        $entity->setLatitude('-12.0301596');
        $entity->setLongitude('-77.0109891');
        $manager->persist($entity);
        $this->addReference('pointofsale-6', $entity);

        $entity = new Pointofsale();
        $entity->setCode('777');
        $entity->setName('Magdalena');
        $entity->setAddress('Jr. Sn. Martin Cdra. 833 Mz.e Lt.9 Los Tulipanes, Magdalena');
        $entity->setPhone('2636376');
        $entity->setSlug('point-of-sale-7');
        $entity->setLatitude('-12.0923916');
        $entity->setLongitude('-77.0707495');
        $manager->persist($entity);
        $this->addReference('pointofsale-7', $entity);

        $entity = new Pointofsale();
        $entity->setCode('888');
        $entity->setName('Miraflores');
        $entity->setAddress('Av. Paseo De República 5260 Miraflores');
        $entity->setPhone('975286372');
        $entity->setSlug('point-of-sale-8');
        $entity->setLatitude('-12.1358307');
        $entity->setLongitude('-77.0178832');
        $manager->persist($entity);
        $this->addReference('pointofsale-8', $entity);

        $entity = new Pointofsale();
        $entity->setCode('999');
        $entity->setName('Plaza Grau');
        $entity->setAddress('Pueblo Joven Cerro El Pino');
        $entity->setPhone('');
        $entity->setSlug('point-of-sale-9');
        $entity->setLatitude('-12.0706228');
        $entity->setLongitude('-77.0004553');
        $manager->persist($entity);
        $this->addReference('pointofsale-9', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1010');
        $entity->setName('Puente Piedra II');
        $entity->setAddress('Av. Panam. norte 680 pasando byPass Puente Piedra');
        $entity->setPhone('997013686');
        $entity->setSlug('point-of-sale-10');
        $entity->setLatitude('-11.861255');
        $entity->setLongitude('-77.0785308');
        $manager->persist($entity);
        $this->addReference('pointofsale-10', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}