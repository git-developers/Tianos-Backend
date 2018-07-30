<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\EscuelaBundle\Entity\Escuela;

class Load_15_EscuelaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        /**
         * ======================================================
         * Ciencias de la Salud
         * ======================================================
         */

        /**
         * Facultad de Medicina
         */
        $facultadMedicina = $this->getReference('facultad-medicina');

        $entity = new Escuela();
        $entity->setCode('111');
        $entity->setName('Medicina Humana');
        $facultadMedicina->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMedicina);

        $entity = new Escuela();
        $entity->setCode('222');
        $entity->setName('Obstetricia');
        $facultadMedicina->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMedicina);

        $entity = new Escuela();
        $entity->setCode('333');
        $entity->setName('Enfermería');
        $facultadMedicina->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMedicina);

        $entity = new Escuela();
        $entity->setCode('444');
        $entity->setName('Tecnología Médica');
        $facultadMedicina->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMedicina);

        $entity = new Escuela();
        $entity->setCode('555');
        $entity->setName('Nutrición');
        $facultadMedicina->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMedicina);


        /**
         * Facultad de Farmacia y Bioquímica
         */
        $facultadFarmacia = $this->getReference('facultad-farmacia');

        $entity = new Escuela();
        $entity->setCode('666');
        $entity->setName('Farmacia y Bioquímica');
        $facultadFarmacia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadFarmacia);

        $entity = new Escuela();
        $entity->setCode('777');
        $entity->setName('Ciencia de los Alimentos');
        $facultadFarmacia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadFarmacia);

        $entity = new Escuela();
        $entity->setCode('888');
        $entity->setName('Toxicología');
        $facultadFarmacia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadFarmacia);


        /**
         * Facultad de Odontología
         */
        $facultadOdontologia = $this->getReference('facultad-odontologia');

        $entity = new Escuela();
        $entity->setCode('999');
        $entity->setName('Odontología');
        $facultadOdontologia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadOdontologia);


        /**
         * Facultad de Medicina Veterinaria
         */
        $facultadVeterinaria = $this->getReference('facultad-veterinaria');

        $entity = new Escuela();
        $entity->setCode('1010');
        $entity->setName('Medicina Veterinaria');
        $facultadVeterinaria->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadVeterinaria);


        /**
         * Facultad de Psicología
         */
        $facultadPsicologia = $this->getReference('facultad-psicologia');

        $entity = new Escuela();
        $entity->setCode('1111');
        $entity->setName('Psicología');
        $facultadPsicologia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadPsicologia);

        $entity = new Escuela();
        $entity->setCode('1212');
        $entity->setName('Psicología Organizacional y de la Gestión Humana');
        $facultadPsicologia->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadPsicologia);




        /**
         * ======================================================
         * Humanidades
         * ======================================================
         */

        /**
         * Facultad de Letras y Ciencias Humanas
         */
        $facultadLetras = $this->getReference('facultad-letras');

        $entity = new Escuela();
        $entity->setCode('1313');
        $entity->setName('Literatura');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1414');
        $entity->setName('Filosofía');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1515');
        $entity->setName('Lingüística');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1616');
        $entity->setName('Comunicación social');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1717');
        $entity->setName('Arte');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1818');
        $entity->setName('Conservación y Restauración');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('1919');
        $entity->setName('Bibliotecología y Ciencias de la Información');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);

        $entity = new Escuela();
        $entity->setCode('2020');
        $entity->setName('Danza');
        $facultadLetras->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadLetras);


        /**
         * Facultad de Educación
         */
        $facultadEducacion = $this->getReference('facultad-educacion');

        $entity = new Escuela();
        $entity->setCode('2121');
        $entity->setName('Educación Inicial');
        $facultadEducacion->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEducacion);

        $entity = new Escuela();
        $entity->setCode('2222');
        $entity->setName('Educación Primaria');
        $facultadEducacion->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEducacion);

        $entity = new Escuela();
        $entity->setCode('2323');
        $entity->setName('Educación Secundaria');
        $facultadEducacion->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEducacion);

        $entity = new Escuela();
        $entity->setCode('2424');
        $entity->setName('Educación Física');
        $facultadEducacion->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEducacion);




        /**
         * ======================================================
         * Ciencias Sociales
         * ======================================================
         */

        /**
         * Facultad de Derecho y Ciencia Política
         */
        $facultadDerecho = $this->getReference('facultad-derecho');

        $entity = new Escuela();
        $entity->setCode('2525');
        $entity->setName('Derecho');
        $facultadDerecho->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadDerecho);

        $entity = new Escuela();
        $entity->setCode('2626');
        $entity->setName('Ciencia Política');
        $facultadDerecho->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadDerecho);


        /**
         * Facultad de Ciencias Sociales
         */
        $facultadSociales = $this->getReference('facultad-sociales');

        $entity = new Escuela();
        $entity->setCode('2727');
        $entity->setName('Historia');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);

        $entity = new Escuela();
        $entity->setCode('2828');
        $entity->setName('Sociología');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);

        $entity = new Escuela();
        $entity->setCode('2929');
        $entity->setName('Antropología');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);

        $entity = new Escuela();
        $entity->setCode('3030');
        $entity->setName('Arqueología');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);

        $entity = new Escuela();
        $entity->setCode('3131');
        $entity->setName('Trabajo Social');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);

        $entity = new Escuela();
        $entity->setCode('3232');
        $entity->setName('Geografía');
        $facultadSociales->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSociales);




        /**
         * ======================================================
         * Ciencias Básicas
         * ======================================================
         */

        /**
         * Facultad de Química e Ingeniería Química
         */
        $facultadQuimica = $this->getReference('facultad-quimica');

        $entity = new Escuela();
        $entity->setCode('3333');
        $entity->setName('Química');
        $facultadQuimica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadQuimica);

        $entity = new Escuela();
        $entity->setCode('3434');
        $entity->setName('Ingeniería Química');
        $facultadQuimica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadQuimica);

        $entity = new Escuela();
        $entity->setCode('3535');
        $entity->setName('Ingeniería Agroindustrial');
        $facultadQuimica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadQuimica);


        /**
         * Facultad de Ciencias Biológicas
         */
        $facultadBiologicas = $this->getReference('facultad-biologicas');

        $entity = new Escuela();
        $entity->setCode('3636');
        $entity->setName('Ciencias Biológicas');
        $facultadBiologicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadBiologicas);

        $entity = new Escuela();
        $entity->setCode('3737');
        $entity->setName('Genética y Biotecnología');
        $facultadBiologicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadBiologicas);

        $entity = new Escuela();
        $entity->setCode('3838');
        $entity->setName('Microbiología y Parasitología');
        $facultadBiologicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadBiologicas);


        /**
         * Facultad de Ciencias Físicas
         */
        $facultadFisicas = $this->getReference('facultad-fisicas');

        $entity = new Escuela();
        $entity->setCode('3939');
        $entity->setName('Física');
        $facultadFisicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadFisicas);

        $entity = new Escuela();
        $entity->setCode('4040');
        $entity->setName('Ingeniería Mecánica de Fluidos');
        $facultadFisicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadFisicas);


        /**
         * Facultad de Ciencias Matemáticas
         */
        $facultadMatematicas = $this->getReference('facultad-matematicas');

        $entity = new Escuela();
        $entity->setCode('4141');
        $entity->setName('Matemática');
        $facultadMatematicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMatematicas);

        $entity = new Escuela();
        $entity->setCode('4242');
        $entity->setName('Estadística');
        $facultadMatematicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMatematicas);

        $entity = new Escuela();
        $entity->setCode('4343');
        $entity->setName('Investigación Operativa');
        $facultadMatematicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMatematicas);

        $entity = new Escuela();
        $entity->setCode('4444');
        $entity->setName('Computación Científica');
        $facultadMatematicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadMatematicas);




        /**
         * ======================================================
         * Ingeniería
         * ======================================================
         */

        /**
         * Facultad de Ingeniería Geológica, Minera, Metalúrgica y Geográfica
         */
        $facultadGeologica = $this->getReference('facultad-geologica');

        $entity = new Escuela();
        $entity->setCode('4545');
        $entity->setName('Ingeniería Geológica');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);

        $entity = new Escuela();
        $entity->setCode('4646');
        $entity->setName('Ingeniería Geográfica');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);

        $entity = new Escuela();
        $entity->setCode('4747');
        $entity->setName('Ingeniería de Minas');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);

        $entity = new Escuela();
        $entity->setCode('4848');
        $entity->setName('Ingeniería Metalúrgica');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);

        $entity = new Escuela();
        $entity->setCode('4949');
        $entity->setName('Ingeniería Civil');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);

        $entity = new Escuela();
        $entity->setCode('5050');
        $entity->setName('Ingeniería Ambiental');
        $facultadGeologica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadGeologica);


        /**
         * Facultad de Ingeniería Industrial
         */
        $facultadIndustrial = $this->getReference('facultad-industrial');

        $entity = new Escuela();
        $entity->setCode('5151');
        $entity->setName('Ingeniería Industrial');
        $facultadIndustrial->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadIndustrial);

        $entity = new Escuela();
        $entity->setCode('5252');
        $entity->setName('Ingeniería Textil y Confecciones');
        $facultadIndustrial->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadIndustrial);

        $entity = new Escuela();
        $entity->setCode('5353');
        $entity->setName('Ingeniería de Seguridad y Salud en el Trabajo');
        $facultadIndustrial->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadIndustrial);


        /**
         * Facultad de Ingeniería Electrónica y Eléctrica
         */
        $facultadElectronica = $this->getReference('facultad-electronica');

        $entity = new Escuela();
        $entity->setCode('5454');
        $entity->setName('Ingeniería Electrónica');
        $facultadElectronica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadElectronica);

        $entity = new Escuela();
        $entity->setCode('5555');
        $entity->setName('Ingeniería Eléctrica');
        $facultadElectronica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadElectronica);

        $entity = new Escuela();
        $entity->setCode('5656');
        $entity->setName('Ingeniería de Telecomunicaciones');
        $facultadElectronica->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadElectronica);


        /**
         * Facultad de Ingeniería de Sistemas e Informática
         */
        $facultadSistemas = $this->getReference('facultad-sistemas');

        $entity = new Escuela();
        $entity->setCode('5757');
        $entity->setName('Ingeniería de Sistemas');
        $facultadSistemas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSistemas);

        $entity = new Escuela();
        $entity->setCode('5858');
        $entity->setName('Ingeniería de Software');
        $facultadSistemas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadSistemas);





        /**
         * ======================================================
         * Económico
         * ======================================================
         */

        /**
         * Facultad de Ciencias Administrativas
         */
        $facultadAdministrativas = $this->getReference('facultad-administrativas');

        $entity = new Escuela();
        $entity->setCode('5959');
        $entity->setName('Administración');
        $facultadAdministrativas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadAdministrativas);

        $entity = new Escuela();
        $entity->setCode('6060');
        $entity->setName('Administración de Turismo');
        $facultadAdministrativas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadAdministrativas);

        $entity = new Escuela();
        $entity->setCode('6161');
        $entity->setName('Administración de Negocios Internacionales');
        $facultadAdministrativas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadAdministrativas);


        /**
         * Facultad de Ciencias Contables
         */
        $facultadContables = $this->getReference('facultad-contables');

        $entity = new Escuela();
        $entity->setCode('6262');
        $entity->setName('Contabilidad');
        $facultadContables->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadContables);

        $entity = new Escuela();
        $entity->setCode('6363');
        $entity->setName('Gestión Tributaria');
        $facultadContables->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadContables);

        $entity = new Escuela();
        $entity->setCode('6464');
        $entity->setName('Auditoría Empresarial y del Sector Público');
        $facultadContables->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadContables);


        /**
         * Facultad de Ciencias Económicas
         */
        $facultadEconomicas = $this->getReference('facultad-economicas');

        $entity = new Escuela();
        $entity->setCode('6565');
        $entity->setName('Economía');
        $facultadEconomicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEconomicas);

        $entity = new Escuela();
        $entity->setCode('6666');
        $entity->setName('Economía Pública');
        $facultadEconomicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEconomicas);

        $entity = new Escuela();
        $entity->setCode('6767');
        $entity->setName('Economía Internacional');
        $facultadEconomicas->addEscuela($entity);
        $manager->persist($entity);
        $manager->persist($facultadEconomicas);



        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 15;
    }
}