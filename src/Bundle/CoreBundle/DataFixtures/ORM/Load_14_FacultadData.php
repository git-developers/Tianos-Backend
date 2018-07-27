<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\FacultadBundle\Entity\Facultad;

class Load_14_FacultadData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * Ciencias de la Salud
         */
        $entity = new Facultad();
        $entity->setCode('111');
        $entity->setName('Facultad de Medicina');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('222');
        $entity->setName('Facultad de Farmacia y Bioquímica');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('333');
        $entity->setName('Facultad de Odontología');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('444');
        $entity->setName('Facultad de Medicina Veterinaria');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('555');
        $entity->setName('Facultad de Psicología');
        $manager->persist($entity);


        /**
         * Humanidades
         */
        $entity = new Facultad();
        $entity->setCode('666');
        $entity->setName('Facultad de Letras y Ciencias Humanas');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('777');
        $entity->setName('Facultad de Educación');
        $manager->persist($entity);


        /**
         * Ciencias Sociales
         */
        $entity = new Facultad();
        $entity->setCode('888');
        $entity->setName('Facultad de Derecho y Ciencia Política');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('999');
        $entity->setName('Facultad de Ciencias Sociales');
        $manager->persist($entity);


        /**
         * Ciencias Básicas
         */
        $entity = new Facultad();
        $entity->setCode('1010');
        $entity->setName('Facultad de Química e Ingeniería Química');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1111');
        $entity->setName('Facultad de Ciencias Biológicas');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1212');
        $entity->setName('Facultad de Ciencias Físicas');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1313');
        $entity->setName('Facultad de Ciencias Matemáticas');
        $manager->persist($entity);


        /**
         * Ingeniería
         */
        $entity = new Facultad();
        $entity->setCode('1414');
        $entity->setName('Facultad de Ingeniería Geológica, Minera, Metalúrgica y Geográfica');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1515');
        $entity->setName('Facultad de Ingeniería Industrial');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1616');
        $entity->setName('Facultad de Ingeniería Electrónica y Eléctrica');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1717');
        $entity->setName('Facultad de Ingeniería de Sistemas e Informática');
        $manager->persist($entity);


        /**
         * Económico
         */
        $entity = new Facultad();
        $entity->setCode('1818');
        $entity->setName('Facultad de Ciencias Administrativas');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('1919');
        $entity->setName('Facultad de Ciencias Contables');
        $manager->persist($entity);

        $entity = new Facultad();
        $entity->setCode('2020');
        $entity->setName('Facultad de Ciencias Económicas');
        $manager->persist($entity);

        $this->addReference('client-default-4', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 14;
    }
}