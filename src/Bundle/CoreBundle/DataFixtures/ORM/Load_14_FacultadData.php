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
        $areaAcademicaSalud = $this->getReference('areaacademica-salud');

        $entity = new Facultad();
        $entity->setCode('111');
        $entity->setName('Facultad de Medicina');
        $areaAcademicaSalud->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSalud);
        $this->addReference('facultad-medicina', $entity);

        $entity = new Facultad();
        $entity->setCode('222');
        $entity->setName('Facultad de Farmacia y Bioquímica');
        $areaAcademicaSalud->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSalud);
        $this->addReference('facultad-farmacia', $entity);

        $entity = new Facultad();
        $entity->setCode('333');
        $entity->setName('Facultad de Odontología');
        $areaAcademicaSalud->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSalud);
        $this->addReference('facultad-odontologia', $entity);

        $entity = new Facultad();
        $entity->setCode('444');
        $entity->setName('Facultad de Medicina Veterinaria');
        $areaAcademicaSalud->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSalud);
        $this->addReference('facultad-veterinaria', $entity);

        $entity = new Facultad();
        $entity->setCode('555');
        $entity->setName('Facultad de Psicología');
        $areaAcademicaSalud->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSalud);
        $this->addReference('facultad-psicologia', $entity);


        /**
         * Humanidades
         */
        $areaAcademicaHumanidades = $this->getReference('areaacademica-humanidades');

        $entity = new Facultad();
        $entity->setCode('666');
        $entity->setName('Facultad de Letras y Ciencias Humanas');
        $areaAcademicaHumanidades->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaHumanidades);
        $this->addReference('facultad-letras', $entity);

        $entity = new Facultad();
        $entity->setCode('777');
        $entity->setName('Facultad de Educación');
        $areaAcademicaHumanidades->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaHumanidades);
        $this->addReference('facultad-educacion', $entity);


        /**
         * Ciencias Sociales
         */
        $areaAcademicaSociales = $this->getReference('areaacademica-sociales');

        $entity = new Facultad();
        $entity->setCode('888');
        $entity->setName('Facultad de Derecho y Ciencia Política');
        $areaAcademicaSociales->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSociales);
        $this->addReference('facultad-derecho', $entity);

        $entity = new Facultad();
        $entity->setCode('999');
        $entity->setName('Facultad de Ciencias Sociales');
        $areaAcademicaSociales->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaSociales);
        $this->addReference('facultad-sociales', $entity);


        /**
         * Ciencias Básicas
         */
        $areaAcademicaCienciaBasica = $this->getReference('areaacademica-ciencia-basica');

        $entity = new Facultad();
        $entity->setCode('1010');
        $entity->setName('Facultad de Química e Ingeniería Química');
        $areaAcademicaCienciaBasica->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaCienciaBasica);
        $this->addReference('facultad-quimica', $entity);

        $entity = new Facultad();
        $entity->setCode('1111');
        $entity->setName('Facultad de Ciencias Biológicas');
        $areaAcademicaCienciaBasica->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaCienciaBasica);
        $this->addReference('facultad-biologicas', $entity);

        $entity = new Facultad();
        $entity->setCode('1212');
        $entity->setName('Facultad de Ciencias Físicas');
        $areaAcademicaCienciaBasica->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaCienciaBasica);
        $this->addReference('facultad-fisicas', $entity);

        $entity = new Facultad();
        $entity->setCode('1313');
        $entity->setName('Facultad de Ciencias Matemáticas');
        $areaAcademicaCienciaBasica->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaCienciaBasica);
        $this->addReference('facultad-matematicas', $entity);


        /**
         * Ingeniería
         */
        $areaAcademicaIngenieria = $this->getReference('areaacademica-ingenieria');

        $entity = new Facultad();
        $entity->setCode('1414');
        $entity->setName('Facultad de Ingeniería Geológica, Minera, Metalúrgica y Geográfica');
        $areaAcademicaIngenieria->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaIngenieria);
        $this->addReference('facultad-geologica', $entity);

        $entity = new Facultad();
        $entity->setCode('1515');
        $entity->setName('Facultad de Ingeniería Industrial');
        $areaAcademicaIngenieria->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaIngenieria);
        $this->addReference('facultad-industrial', $entity);

        $entity = new Facultad();
        $entity->setCode('1616');
        $entity->setName('Facultad de Ingeniería Electrónica y Eléctrica');
        $areaAcademicaIngenieria->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaIngenieria);
        $this->addReference('facultad-electronica', $entity);

        $entity = new Facultad();
        $entity->setCode('1717');
        $entity->setName('Facultad de Ingeniería de Sistemas e Informática');
        $areaAcademicaIngenieria->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaIngenieria);
        $this->addReference('facultad-sistemas', $entity);


        /**
         * Económico
         */
        $areaAcademicaEconomico = $this->getReference('areaacademica-economico');

        $entity = new Facultad();
        $entity->setCode('1818');
        $entity->setName('Facultad de Ciencias Administrativas');
        $areaAcademicaEconomico->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaEconomico);
        $this->addReference('facultad-administrativas', $entity);

        $entity = new Facultad();
        $entity->setCode('1919');
        $entity->setName('Facultad de Ciencias Contables');
        $areaAcademicaEconomico->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaEconomico);
        $this->addReference('facultad-contables', $entity);

        $entity = new Facultad();
        $entity->setCode('2020');
        $entity->setName('Facultad de Ciencias Económicas');
        $areaAcademicaEconomico->addFacultad($entity);
        $manager->persist($entity);
        $manager->persist($areaAcademicaEconomico);
        $this->addReference('facultad-economicas', $entity);



//        $this->addReference('client-default-4', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 14;
    }
}