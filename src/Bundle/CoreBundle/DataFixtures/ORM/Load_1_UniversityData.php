<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UniversityBundle\Entity\University;

class Load_1_UniversityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new University();
        $entity->setCode('111');
        $entity->setAbbreviation('UNI');
        $entity->setName('Universidad Nacional de Ingeniería');
        $manager->persist($entity);
        $this->addReference('university-uni', $entity);

        $entity = new University();
        $entity->setCode('222');
        $entity->setAbbreviation('UTP');
        $entity->setName('Universidad Tecnológica del Perú');
        $manager->persist($entity);
        $this->addReference('university-utp', $entity);

        $entity = new University();
        $entity->setCode('333');
        $entity->setAbbreviation('URP');
        $entity->setName('Universidad Ricardo Palma');
        $manager->persist($entity);
        $this->addReference('university-urp', $entity);

        $entity = new University();
        $entity->setCode('444');
        $entity->setAbbreviation('UPC');
        $entity->setName('Universidad Peruana de Ciencias Aplicadas');
        $manager->persist($entity);
        $this->addReference('university-upc', $entity);

        $entity = new University();
        $entity->setCode('555');
        $entity->setAbbreviation('UNMSM');
        $entity->setName('Universidad Nacional Mayor de San Marcos');
        $manager->persist($entity);
        $this->addReference('university-unmsm', $entity);

        $entity = new University();
        $entity->setCode('666');
        $entity->setAbbreviation('UNFV');
        $entity->setName('Universidad Nacional Federico Villarreal');
        $manager->persist($entity);

        $entity = new University();
        $entity->setCode('777');
        $entity->setAbbreviation('USIL');
        $entity->setName('Universidad San Ignacio de Loyola');
        $manager->persist($entity);
        $this->addReference('university-usil', $entity);

        $entity = new University();
        $entity->setCode('888');
        $entity->setAbbreviation('UNIFE');
        $entity->setName('Universidad Femenina del Sagrado Corazón');
        $manager->persist($entity);
        $this->addReference('university-unife', $entity);

        $entity = new University();
        $entity->setCode('999');
        $entity->setAbbreviation('UL');
        $entity->setName('Universidad de Lima');
        $manager->persist($entity);
        $this->addReference('university-ul', $entity);

        $entity = new University();
        $entity->setCode('999');
        $entity->setAbbreviation('UDEP');
        $entity->setName('Universidad de Piura');
        $manager->persist($entity);
        $this->addReference('university-udep', $entity);

        $entity = new University();
        $entity->setCode('999');
        $entity->setAbbreviation('USMP');
        $entity->setName('Universidad de San Martín de Porres');
        $manager->persist($entity);
        $this->addReference('university-usmp', $entity);

        $entity = new University();
        $entity->setCode('1010');
        $entity->setAbbreviation('UP');
        $entity->setName('Universidad del Pacífico');
        $manager->persist($entity);
        $this->addReference('university-up', $entity);

        $entity = new University();
        $entity->setCode('1111');
        $entity->setAbbreviation('UE');
        $entity->setName('Universidad ESAN');
        $manager->persist($entity);
        $this->addReference('university-ue', $entity);

        $entity = new University();
        $entity->setCode('1212');
        $entity->setAbbreviation('PUCP');
        $entity->setName('Pontificia Universidad Católica del Perú');
        $manager->persist($entity);
        $this->addReference('university-pucp', $entity);

        $entity = new University();
        $entity->setCode('1313');
        $entity->setAbbreviation('UAP');
        $entity->setName('Universidad Alas Peruanas');
        $manager->persist($entity);
        $this->addReference('university-uap', $entity);

        $entity = new University();
        $entity->setCode('1414');
        $entity->setAbbreviation('UCV');
        $entity->setName('Universidad César Vallejo');
        $manager->persist($entity);
        $this->addReference('university-ucv', $entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}