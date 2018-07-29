<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\AreaacademicaBundle\Entity\Areaacademica;

//https://es.wikipedia.org/wiki/Anexo:Facultades_y_Escuelas_de_la_Universidad_Nacional_Mayor_de_San_Marcos

class Load_13_AreaacademicaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $universityUni = $this->getReference('university-uni');


        $entity = new Areaacademica();
        $entity->setCode('111');
        $entity->setName('Ciencias Básicas');
        $universityUni->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $this->addReference('areaacademica-ciencia-basica', $entity);

        $entity = new Areaacademica();
        $entity->setCode('222');
        $entity->setName('Humanidades');
        $manager->persist($entity);

        $entity = new Areaacademica();
        $entity->setCode('333');
        $entity->setName('Ciencias Sociales');
        $manager->persist($entity);

        $entity = new Areaacademica();
        $entity->setCode('444');
        $entity->setName('Ciencias de la Salud');
        $manager->persist($entity);

        $entity = new Areaacademica();
        $entity->setCode('555');
        $entity->setName('Ingeniería');
        $universityUni->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $this->addReference('areaacademica-ingenieria', $entity);

        $entity = new Areaacademica();
        $entity->setCode('666');
        $entity->setName('Económico');
        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 13;
    }
}