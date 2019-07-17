<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\PointofsaleBundle\Entity\Pointofsale;

class Load_9_PointofsaleData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {
        $dateCreatedAt = "2018-05-11";

        $canillita_1 = $this->getReference('canillita-1');
        $canillita_2 = $this->getReference('canillita-2');
        $canillita_3 = $this->getReference('canillita-3');
        $canillita_4 = $this->getReference('canillita-4');
        $canillita_5 = $this->getReference('canillita-5');
        $canillita_6 = $this->getReference('canillita-6');
        $canillita_7 = $this->getReference('canillita-7');
        $canillita_8 = $this->getReference('canillita-8');
        $canillita_9 = $this->getReference('canillita-9');

        $canillita_10 = $this->getReference('canillita-10');
        $canillita_11 = $this->getReference('canillita-11');
        $canillita_12 = $this->getReference('canillita-12');
        $canillita_13 = $this->getReference('canillita-13');
        $canillita_14 = $this->getReference('canillita-14');
        $canillita_15 = $this->getReference('canillita-15');
        $canillita_16 = $this->getReference('canillita-16');
        $canillita_17 = $this->getReference('canillita-17');
        $canillita_18 = $this->getReference('canillita-18');
        $canillita_19 = $this->getReference('canillita-19');

        $canillita_20 = $this->getReference('canillita-20');
        $canillita_21 = $this->getReference('canillita-21');
        $canillita_22 = $this->getReference('canillita-22');
        $canillita_23 = $this->getReference('canillita-23');
        $canillita_24 = $this->getReference('canillita-24');
        $canillita_25 = $this->getReference('canillita-25');
        $canillita_26 = $this->getReference('canillita-26');
        $canillita_27 = $this->getReference('canillita-27');
        $canillita_28 = $this->getReference('canillita-28');
        $canillita_29 = $this->getReference('canillita-29');

        $canillita_30 = $this->getReference('canillita-30');
        $canillita_31 = $this->getReference('canillita-31');
        $canillita_32 = $this->getReference('canillita-32');
        $canillita_33 = $this->getReference('canillita-33');
        $canillita_34 = $this->getReference('canillita-34');
        $canillita_35 = $this->getReference('canillita-35');
        $canillita_36 = $this->getReference('canillita-36');
        $canillita_37 = $this->getReference('canillita-37');
        $canillita_38 = $this->getReference('canillita-38');
        $canillita_39 = $this->getReference('canillita-39');

        $canillita_40 = $this->getReference('canillita-40');
        $canillita_41 = $this->getReference('canillita-41');
        $canillita_42 = $this->getReference('canillita-42');
        $canillita_43 = $this->getReference('canillita-43');
        $canillita_44 = $this->getReference('canillita-44');
        $canillita_45 = $this->getReference('canillita-45');
        $canillita_46 = $this->getReference('canillita-46');
        $canillita_47 = $this->getReference('canillita-47');
        $canillita_48 = $this->getReference('canillita-48');
        $canillita_49 = $this->getReference('canillita-49');

        $canillita_50 = $this->getReference('canillita-50');
        $canillita_51 = $this->getReference('canillita-51');
        $canillita_52 = $this->getReference('canillita-52');
        $canillita_53 = $this->getReference('canillita-53');
        $canillita_54 = $this->getReference('canillita-54');
        $canillita_55 = $this->getReference('canillita-55');
        $canillita_56 = $this->getReference('canillita-56');
        $canillita_57 = $this->getReference('canillita-57');
        $canillita_58 = $this->getReference('canillita-58');
        $canillita_59 = $this->getReference('canillita-59');
        $canillita_60 = $this->getReference('canillita-60');




        $entity = new Pointofsale();
        $entity->setCode('111');
        $entity->setName('Aeropuerto');
        $entity->setAddress('Av. Tomas Valle Mz.g 37 Lt.31 Aa.hh Bocanegra Callao');
        $entity->setPhone('994826014');
        $entity->setSlug('point-of-sale-1');
        $entity->setLatitude('-12.0240716');
        $entity->setLongitude('-77.1120326');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_1);
        $entity->addUser2($canillita_2);
        $entity->addUser2($canillita_3);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_4);
        $entity->addUser2($canillita_5);
        $entity->addUser2($canillita_6);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_7);
        $entity->addUser2($canillita_8);
        $entity->addUser2($canillita_9);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_10);
        $entity->addUser2($canillita_11);
        $entity->addUser2($canillita_12);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_13);
        $entity->addUser2($canillita_14);
        $entity->addUser2($canillita_15);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_16);
        $entity->addUser2($canillita_17);
        $entity->addUser2($canillita_18);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_19);
        $entity->addUser2($canillita_20);
        $entity->addUser2($canillita_21);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_22);
        $entity->addUser2($canillita_23);
        $entity->addUser2($canillita_24);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_25);
        $entity->addUser2($canillita_26);
        $entity->addUser2($canillita_27);
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
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_28);
        $entity->addUser2($canillita_29);
        $entity->addUser2($canillita_30);
        $manager->persist($entity);
        $this->addReference('pointofsale-10', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1111');
        $entity->setName('Salamanca');
        $entity->setAddress('Jr. Galvez Silvera No.252 San Luis');
        $entity->setPhone('995671121');
        $entity->setSlug('point-of-sale-11');
        $entity->setLatitude('-12.0745763');
        $entity->setLongitude('-76.993367');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_31);
        $entity->addUser2($canillita_32);
        $entity->addUser2($canillita_33);
        $manager->persist($entity);
        $this->addReference('pointofsale-11', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1212');
        $entity->setName('San Borja');
        $entity->setAddress('Av.Aviacion 2529, San Borja');
        $entity->setPhone('987471690');
        $entity->setSlug('point-of-sale-12');
        $entity->setLatitude('-12.0913748');
        $entity->setLongitude('-77.0029586');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_34);
        $entity->addUser2($canillita_35);
        $entity->addUser2($canillita_36);
        $manager->persist($entity);
        $this->addReference('pointofsale-12', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1313');
        $entity->setName('San Martin De Porres');
        $entity->setAddress('Jr. El Chaco No. 2264, San Martin de Porres');
        $entity->setPhone('5712952');
        $entity->setSlug('point-of-sale-13');
        $entity->setLatitude('-12.0306604');
        $entity->setLongitude('-77.0690611');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_37);
        $entity->addUser2($canillita_38);
        $entity->addUser2($canillita_39);
        $manager->persist($entity);
        $this->addReference('pointofsale-13', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1414');
        $entity->setName('Surquillo');
        $entity->setAddress('Jr. Gonzales Prada 452, Surquillo');
        $entity->setPhone('948970027');
        $entity->setSlug('point-of-sale-14');
        $entity->setLatitude('-12.1167489');
        $entity->setLongitude('-77.0256055');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_40);
        $entity->addUser2($canillita_41);
        $entity->addUser2($canillita_42);
        $manager->persist($entity);
        $this->addReference('pointofsale-14', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1515');
        $entity->setName('Ventanilla II');
        $entity->setAddress('Mercado Santa Rosa s/n Stand 8, Ventanilla');
        $entity->setPhone('994441442');
        $entity->setSlug('point-of-sale-15');
        $entity->setLatitude('-11.8253926');
        $entity->setLongitude('-77.1328608');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_43);
        $entity->addUser2($canillita_44);
        $entity->addUser2($canillita_45);
        $manager->persist($entity);
        $this->addReference('pointofsale-15', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1616');
        $entity->setName('Zarumilla');
        $entity->setAddress('Jr. Sao Paulo Cdra.11 Costado Municipalidad de SMP');
        $entity->setPhone('998036192');
        $entity->setSlug('point-of-sale-16');
        $entity->setLatitude('-12.0306636');
        $entity->setLongitude('-77.0575724');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_46);
        $entity->addUser2($canillita_47);
        $entity->addUser2($canillita_48);
        $manager->persist($entity);
        $this->addReference('pointofsale-16', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1717');
        $entity->setName('Tomas Marsano');
        $entity->setAddress('Av. Tomas Marsano 1627, Surco');
        $entity->setPhone('997782018');
        $entity->setSlug('point-of-sale-17');
        $entity->setLatitude('-12.1186511');
        $entity->setLongitude('-77.0078432');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_49);
        $entity->addUser2($canillita_50);
        $entity->addUser2($canillita_51);
        $manager->persist($entity);
        $this->addReference('pointofsale-17', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1818');
        $entity->setName('Chacarilla');
        $entity->setAddress('Pje. Nepeña Cdra.1 Av.la Encalada Cdra.6 Stgo Surco');
        $entity->setPhone('996463700');
        $entity->setSlug('point-of-sale-18');
        $entity->setLatitude('-12.1052368');
        $entity->setLongitude('-76.9708808');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_52);
        $entity->addUser2($canillita_53);
        $entity->addUser2($canillita_54);
        $manager->persist($entity);
        $this->addReference('pointofsale-18', $entity);

        $entity = new Pointofsale();
        $entity->setCode('1919');
        $entity->setName('Comas');
        $entity->setAddress('Av. Mexico 148 Urb. Parral Km.11 Panamericana Norte');
        $entity->setPhone('997762321');
        $entity->setSlug('point-of-sale-19');
        $entity->setLatitude('-11.9424768');
        $entity->setLongitude('-77.0717141');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_55);
        $entity->addUser2($canillita_56);
        $entity->addUser2($canillita_57);
        $manager->persist($entity);
        $this->addReference('pointofsale-19', $entity);

        $entity = new Pointofsale();
        $entity->setCode('2020');
        $entity->setName('Plaza Mexico');
        $entity->setAddress('Calle Amatistas 227 Balconcillo');
        $entity->setPhone('988419611');
        $entity->setSlug('point-of-sale-20');
        $entity->setLatitude('-12.0746298');
        $entity->setLongitude('-77.0225325');
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->addUser2($canillita_58);
        $entity->addUser2($canillita_59);
        $entity->addUser2($canillita_60);
        $manager->persist($entity);
        $this->addReference('pointofsale-20', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }
}