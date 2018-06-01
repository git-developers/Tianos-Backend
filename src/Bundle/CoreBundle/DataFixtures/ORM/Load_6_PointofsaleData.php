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
        $entity->setAddress('Av. Tomas Valle Mz.g 37 Lt.31 Aa.hh Bocanegra Callao');
        $entity->setPhone('994826014');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0240716');
        $entity->setLongitude('-77.1120326');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('222');
        $entity->setName('Barranco');
        $entity->setAddress('Calle Union 208, Barranco');
        $entity->setPhone('2484434');
        $entity->setSlug('point-of-sale-2');
        $entity->setLatitude('-12.1476123');
        $entity->setLongitude('-77.021375');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('333');
        $entity->setName('Chorrillos');
        $entity->setAddress('Jr. Delfín Puccio Mz.a Lt.8 Urb.san Juan, Chorrillos');
        $entity->setPhone('998461653');
        $entity->setSlug('point-of-sale-3');
        $entity->setLatitude('-12.0982821');
        $entity->setLongitude('-76.9620132');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('444');
        $entity->setName('El Porvenir');
        $entity->setAddress('Jr. Garibaldi 367, La Victoria');
        $entity->setPhone('5731246');
        $entity->setSlug('point-of-sale-4');
        $entity->setLatitude('-12.0625411');
        $entity->setLongitude('-77.0167905');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('555');
        $entity->setName('La Molina');
        $entity->setAddress('Av. La Molina 740');
        $entity->setPhone('999040550');
        $entity->setSlug('point-of-sale-5');
        $entity->setLatitude('-12.0660291');
        $entity->setLongitude('-76.959109');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('666');
        $entity->setName('Lurigancho');
        $entity->setAddress('Av. Gran Chimu 1era Crda Zarate, Lurigancho (Porton Plomo)');
        $entity->setPhone('999339483');
        $entity->setSlug('point-of-sale-6');
        $entity->setLatitude('-12.0301596');
        $entity->setLongitude('-77.0109891');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('777');
        $entity->setName('Magdalena');
        $entity->setAddress('Jr. Sn. Martin Cdra. 833 Mz.e Lt.9 Los Tulipanes, Magdalena');
        $entity->setPhone('2636376');
        $entity->setSlug('point-of-sale-7');
        $entity->setLatitude('-12.0923916');
        $entity->setLongitude('-77.0707495');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('888');
        $entity->setName('Miraflores');
        $entity->setAddress('Av. Paseo De República 5260 Miraflores');
        $entity->setPhone('975286372');
        $entity->setSlug('point-of-sale-8');
        $entity->setLatitude('-12.1358307');
        $entity->setLongitude('-77.0178832');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('999');
        $entity->setName('Plaza Grau');
        $entity->setAddress('Pueblo Joven Cerro El Pino');
        $entity->setPhone('');
        $entity->setSlug('point-of-sale-9');
        $entity->setLatitude('-12.0706228');
        $entity->setLongitude('-77.0004553');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1010');
        $entity->setName('Puente Piedra II');
        $entity->setAddress('Av. Panam. norte 680 pasando byPass Puente Piedra');
        $entity->setPhone('997013686');
        $entity->setSlug('point-of-sale-10');
        $entity->setLatitude('-11.861255');
        $entity->setLongitude('-77.0785308');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1111');
        $entity->setName('Salamanca');
        $entity->setAddress('Jr. Galvez Silvera No.252 San Luis');
        $entity->setPhone('995671121');
        $entity->setSlug('point-of-sale-11');
        $entity->setLatitude('-12.0745763');
        $entity->setLongitude('-76.993367');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1212');
        $entity->setName('San Borja');
        $entity->setAddress('Av.Aviacion 2529, San Borja');
        $entity->setPhone('987471690');
        $entity->setSlug('point-of-sale-12');
        $entity->setLatitude('-12.0913748');
        $entity->setLongitude('-77.0029586');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1313');
        $entity->setName('San Martin De Porres');
        $entity->setAddress('Jr. El Chaco No. 2264, San Martin de Porres');
        $entity->setPhone('5712952');
        $entity->setSlug('point-of-sale-13');
        $entity->setLatitude('-12.0306604');
        $entity->setLongitude('-77.0690611');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1414');
        $entity->setName('Surquillo');
        $entity->setAddress('Jr. Gonzales Prada 452, Surquillo');
        $entity->setPhone('948970027');
        $entity->setSlug('point-of-sale-14');
        $entity->setLatitude('-12.1167489');
        $entity->setLongitude('-77.0256055');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1515');
        $entity->setName('Ventanilla II');
        $entity->setAddress('Mercado Santa Rosa s/n Stand 8, Ventanilla');
        $entity->setPhone('994441442');
        $entity->setSlug('point-of-sale-15');
        $entity->setLatitude('-11.8253926');
        $entity->setLongitude('-77.1328608');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1616');
        $entity->setName('Zarumilla');
        $entity->setAddress('Jr. Sao Paulo Cdra.11 Costado Municipalidad de SMP');
        $entity->setPhone('998036192');
        $entity->setSlug('point-of-sale-16');
        $entity->setLatitude('-12.0306636');
        $entity->setLongitude('-77.0575724');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1717');
        $entity->setName('Tomas Marsano');
        $entity->setAddress('Av. Tomas Marsano 1627, Surco');
        $entity->setPhone('997782018');
        $entity->setSlug('point-of-sale-17');
        $entity->setLatitude('-12.1186511');
        $entity->setLongitude('-77.0078432');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1818');
        $entity->setName('Chacarilla');
        $entity->setAddress('Pje. Nepeña Cdra.1 Av.la Encalada Cdra.6 Stgo Surco');
        $entity->setPhone('996463700');
        $entity->setSlug('point-of-sale-18');
        $entity->setLatitude('-12.1052368');
        $entity->setLongitude('-76.9708808');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('1919');
        $entity->setName('Comas');
        $entity->setAddress('Av. Mexico 148 Urb. Parral Km.11 Panamericana Norte');
        $entity->setPhone('997762321');
        $entity->setSlug('point-of-sale-19');
        $entity->setLatitude('-11.9424768');
        $entity->setLongitude('-77.0717141');
        $manager->persist($entity);

        $entity = new Pointofsale();
        $entity->setCode('2020');
        $entity->setName('Plaza Mexico');
        $entity->setAddress('Calle Amatistas 227 Balconcillo');
        $entity->setPhone('988419611');
        $entity->setSlug('point-of-sale-20');
        $entity->setLatitude('-12.0746298');
        $entity->setLongitude('-77.0225325');
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