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
        $entity = new Escuela();
        $entity->setCode('111');
        $entity->setName('Medicina Humana');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('222');
        $entity->setName('Obstetricia');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('333');
        $entity->setName('Enfermería');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('444');
        $entity->setName('Tecnología Médica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('555');
        $entity->setName('Nutrición');
        $manager->persist($entity);


        /**
         * Facultad de Farmacia y Bioquímica
         */
        $entity = new Escuela();
        $entity->setCode('666');
        $entity->setName('Farmacia y Bioquímica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('777');
        $entity->setName('Ciencia de los Alimentos');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('888');
        $entity->setName('Toxicología');
        $manager->persist($entity);


        /**
         * Facultad de Odontología
         */
        $entity = new Escuela();
        $entity->setCode('999');
        $entity->setName('Odontología');
        $manager->persist($entity);


        /**
         * Facultad de Medicina Veterinaria
         */
        $entity = new Escuela();
        $entity->setCode('1010');
        $entity->setName('Medicina Veterinaria');
        $manager->persist($entity);


        /**
         * Facultad de Psicología
         */
        $entity = new Escuela();
        $entity->setCode('1111');
        $entity->setName('Psicología');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1212');
        $entity->setName('Psicología Organizacional y de la Gestión Humana');
        $manager->persist($entity);




        /**
         * ======================================================
         * Humanidades
         * ======================================================
         */

        /**
         * Facultad de Letras y Ciencias Humanas
         */
        $entity = new Escuela();
        $entity->setCode('1313');
        $entity->setName('Literatura');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1414');
        $entity->setName('Filosofía');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1515');
        $entity->setName('Lingüística');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1616');
        $entity->setName('Comunicación social');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1717');
        $entity->setName('Arte');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1818');
        $entity->setName('Conservación y Restauración');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('1919');
        $entity->setName('Bibliotecología y Ciencias de la Información');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2020');
        $entity->setName('Danza');
        $manager->persist($entity);


        /**
         * Facultad de Educación
         */
        $entity = new Escuela();
        $entity->setCode('2121');
        $entity->setName('Educación Inicial');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2222');
        $entity->setName('Educación Primaria');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2323');
        $entity->setName('Educación Secundaria');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2424');
        $entity->setName('Educación Física');
        $manager->persist($entity);




        /**
         * ======================================================
         * Ciencias Sociales
         * ======================================================
         */

        /**
         * Facultad de Derecho y Ciencia Política
         */
        $entity = new Escuela();
        $entity->setCode('2525');
        $entity->setName('Derecho');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2626');
        $entity->setName('Ciencia Política');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Sociales
         */
        $entity = new Escuela();
        $entity->setCode('2727');
        $entity->setName('Historia');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2828');
        $entity->setName('Sociología');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('2929');
        $entity->setName('Antropología');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3030');
        $entity->setName('Arqueología');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3131');
        $entity->setName('Trabajo Social');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3232');
        $entity->setName('Geografía');
        $manager->persist($entity);




        /**
         * ======================================================
         * Ciencias Básicas
         * ======================================================
         */

        /**
         * Facultad de Química e Ingeniería Química
         */
        $entity = new Escuela();
        $entity->setCode('3333');
        $entity->setName('Química');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3434');
        $entity->setName('Ingeniería Química');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3535');
        $entity->setName('Ingeniería Agroindustrial');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Biológicas
         */
        $entity = new Escuela();
        $entity->setCode('3636');
        $entity->setName('Ciencias Biológicas');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3737');
        $entity->setName('Genética y Biotecnología');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('3838');
        $entity->setName('Microbiología y Parasitología');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Físicas
         */
        $entity = new Escuela();
        $entity->setCode('3939');
        $entity->setName('Física');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4040');
        $entity->setName('Ingeniería Mecánica de Fluidos');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Matemáticas
         */
        $entity = new Escuela();
        $entity->setCode('4141');
        $entity->setName('Matemática');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4242');
        $entity->setName('Estadística');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4343');
        $entity->setName('Investigación Operativa');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4444');
        $entity->setName('Computación Científica');
        $manager->persist($entity);




        /**
         * ======================================================
         * Ingeniería
         * ======================================================
         */

        /**
         * Facultad de Ingeniería Geológica, Minera, Metalúrgica y Geográfica
         */
        $entity = new Escuela();
        $entity->setCode('4545');
        $entity->setName('Ingeniería Geológica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4646');
        $entity->setName('Ingeniería Geográfica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4747');
        $entity->setName('Ingeniería de Minas');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4848');
        $entity->setName('Ingeniería Metalúrgica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('4949');
        $entity->setName('Ingeniería Civil');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5050');
        $entity->setName('Ingeniería Ambiental');
        $manager->persist($entity);


        /**
         * Facultad de Ingeniería Industrial
         */
        $entity = new Escuela();
        $entity->setCode('5151');
        $entity->setName('Ingeniería Industrial');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5252');
        $entity->setName('Ingeniería Textil y Confecciones');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5353');
        $entity->setName('Ingeniería de Seguridad y Salud en el Trabajo');
        $manager->persist($entity);


        /**
         * Facultad de Ingeniería Electrónica y Eléctrica
         */
        $entity = new Escuela();
        $entity->setCode('5454');
        $entity->setName('Ingeniería Electrónica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5555');
        $entity->setName('Ingeniería Eléctrica');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5656');
        $entity->setName('Ingeniería de Telecomunicaciones');
        $manager->persist($entity);


        /**
         * Facultad de Ingeniería de Sistemas e Informática
         */
        $entity = new Escuela();
        $entity->setCode('5757');
        $entity->setName('Ingeniería de Sistemas');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('5858');
        $entity->setName('Ingeniería de Software');
        $manager->persist($entity);





        /**
         * ======================================================
         * Económico
         * ======================================================
         */

        /**
         * Facultad de Ciencias Administrativas
         */
        $entity = new Escuela();
        $entity->setCode('5959');
        $entity->setName('Administración');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6060');
        $entity->setName('Administración de Turismo');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6161');
        $entity->setName('Administración de Negocios Internacionales');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Contables
         */
        $entity = new Escuela();
        $entity->setCode('6262');
        $entity->setName('Contabilidad');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6363');
        $entity->setName('Gestión Tributaria');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6464');
        $entity->setName('Auditoría Empresarial y del Sector Público');
        $manager->persist($entity);


        /**
         * Facultad de Ciencias Económicas
         */
        $entity = new Escuela();
        $entity->setCode('6565');
        $entity->setName('Economía');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6666');
        $entity->setName('Economía Pública');
        $manager->persist($entity);

        $entity = new Escuela();
        $entity->setCode('6767');
        $entity->setName('Economía Internacional');
        $manager->persist($entity);



        $this->addReference('client-default-8', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 15;
    }
}