<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\UserBundle\Entity\User;

class Load_4_UserData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $dateCreatedAt = "2018-05-11";
        $clientePlantaCentroPando = $this->getReference('cliente-planta-centro-pando');

        $profileAdmin = $this->getReference('profile-admin');
        $profileJefeAdministracionComercial = $this->getReference('profile-jefe-administracion-comercial');
        $profileAsistenteDistribucionTransporte = $this->getReference('profile-asistente-distribucion-transporte');
        $profileGerenteVentas = $this->getReference('profile-gerente-ventas');
        $profileSupervisorVenta = $this->getReference('profile-supervisor-venta');
        $profileJefeVenta = $this->getReference('profile-jefe-venta');
        $profileJefeAlmacen = $this->getReference('profile-jefe-almacen');
        $profileTransportista = $this->getReference('profile-transportista');
        $profileDistribuidor = $this->getReference('profile-distribuidor');
        $profileCanillita = $this->getReference('profile-canillita');

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setPassword('123');
        $entity->setName('Alfredo');
        $entity->setLastName('Bringas');
        $entity->setEmail('abringas@' . $this->applicationUrl);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);


        /**
         * ADMINISTRACION COMERCIAL
         */
        $entity = new User();
        $entity->setDni('12345677');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ricardo');
        $entity->setLastName('Masias');
        $entity->setEmail('rmasias@' . $this->applicationUrl);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileJefeAdministracionComercial);
        $manager->persist($entity);


        /**
         * ASISTENTE DISTRIBUCION Y TRANSPORTE
         */
        $entity = new User();
        $entity->setDni('87654321');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Mariano');
        $entity->setLastName('Cardenas');
        $entity->setEmail('mcardenas@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileAsistenteDistribucionTransporte);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);



        /**
         * GERENTE DE VENTAS
         */
        $entity = new User();
        $entity->setDni('34758322');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alex');
        $entity->setLastName('Quillay');
        $entity->setEmail('aquillay@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileGerenteVentas);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        /**
         * SUPERVISOR DE VENTA
         */
        $entity = new User();
        $entity->setDni('53748592');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jaime');
        $entity->setLastName('Dominguez');
        $entity->setEmail('jdominguez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileSupervisorVenta);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        /**
         * JEFE DE VENTA
         */
        $entity = new User();
        $entity->setDni('34859274');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Albino');
        $entity->setLastName('Melendez');
        $entity->setEmail('amelendez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileJefeVenta);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        /**
         * JEFE DE ALMACEN
         */
        $entity = new User();
        $entity->setDni('40273821');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Roberto');
        $entity->setLastName('Espinoza');
        $entity->setEmail('respinoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileJefeAlmacen);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);




        /**
         * TRANSPORTISTAS
         */
        $entity = new User();
        $entity->setDni('23456734');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Luis');
        $entity->setLastName('Huamani');
        $entity->setEmail('lhuamani@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('34252311');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Carlos');
        $entity->setLastName('Maldonado');
        $entity->setEmail('cmaldonado@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('99887736');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Hector');
        $entity->setLastName('Ruiz');
        $entity->setEmail('hruiz@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645346');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jorge');
        $entity->setLastName('Linares');
        $entity->setEmail('jlinares@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645347');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Salvador');
        $entity->setLastName('Garcia');
        $entity->setEmail('sgarcia@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645348');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Gilberto');
        $entity->setLastName('Campos');
        $entity->setEmail('gcampos@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645349');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Javier');
        $entity->setLastName('Palomares');
        $entity->setEmail('jpalomares@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645342');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Juan');
        $entity->setLastName('Olivera');
        $entity->setEmail('jolivera@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        /**
         * TRANSPORTISTAS
         */



        /**
         * DISTRIBUIDORES
         */
        $entity = new User(); // Aeropuerto
        $entity->setDni('97364534');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alejandro');
        $entity->setLastName('Santander');
        $entity->setEmail('asantander@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Barranco
        $entity->setDni('63738499');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Fernandez');
        $entity->setLastName('Miranda');
        $entity->setEmail('fmiranda@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Chorrillos
        $entity->setDni('45637482');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Florentino');
        $entity->setLastName('Paucar');
        $entity->setEmail('fpaucar@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // El Porvenir
        $entity->setDni('34568498');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Felix');
        $entity->setLastName('Moreno');
        $entity->setEmail('fmoreno@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // La Molina
        $entity->setDni('98574657');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Prospero');
        $entity->setLastName('Rivera');
        $entity->setEmail('privera@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Lurigancho
        $entity->setDni('34344556');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ruth');
        $entity->setLastName('Aguirre');
        $entity->setEmail('raguirre@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Magdalena
        $entity->setDni('76523423');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jimenez');
        $entity->setLastName('Catalina');
        $entity->setEmail('jcatalina@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Miraflores
        $entity->setDni('45362374');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Priscila');
        $entity->setLastName('Espinoza');
        $entity->setEmail('pespinoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Plaza Grau
        $entity->setDni('76542398');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Elisa');
        $entity->setLastName('Mendez');
        $entity->setEmail('emendez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Puente Piedra II
        $entity->setDni('55883245');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Faustino');
        $entity->setLastName('Sanchez');
        $entity->setEmail('fsanchez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Salamanca
        $entity->setDni('55434538');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Martha');
        $entity->setLastName('Trujillo');
        $entity->setEmail('mtrujillo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // San Borja
        $entity->setDni('65287633');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Marcelina');
        $entity->setLastName('Rojas');
        $entity->setEmail('mrojas@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // San Martin De Porres
        $entity->setDni('65432789');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Maria');
        $entity->setLastName('Perez');
        $entity->setEmail('mperez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Surquillo
        $entity->setDni('63523498');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Baseliza');
        $entity->setLastName('Marin');
        $entity->setEmail('bmarin@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Ventanilla II
        $entity->setDni('34527832');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Edilberto');
        $entity->setLastName('Sarmiento');
        $entity->setEmail('esarmiento@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Zarumilla
        $entity->setDni('76534562');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jose');
        $entity->setLastName('Flores');
        $entity->setEmail('jflores@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Tomas Marsano
        $entity->setDni('37482392');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Nestor');
        $entity->setLastName('Flores');
        $entity->setEmail('nflores@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Chacarilla
        $entity->setDni('57363723');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alejandra');
        $entity->setLastName('Parco');
        $entity->setEmail('aparco@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Comas
        $entity->setDni('58693784');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Enrique');
        $entity->setLastName('Leon');
        $entity->setEmail('eleon@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // Plaza Mexico
        $entity->setDni('25436423');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Henry');
        $entity->setLastName('Patazca');
        $entity->setEmail('hpatazca@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        /**
         * DISTRIBUIDORES
         */




        /**
         * CANILLITAS
         */
        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Pedro');
        $entity->setLastName('Zavaleta');
        $entity->setEmail('pzavaleta@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Carlos');
        $entity->setLastName('Gonzales');
        $entity->setEmail('cgonzales@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Hector');
        $entity->setLastName('Galvan');
        $entity->setEmail('hgalvan@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jorge');
        $entity->setLastName('Castaña');
        $entity->setEmail('jcastaña@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Miguel');
        $entity->setLastName('Andrade');
        $entity->setEmail('mandrade@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Martin');
        $entity->setLastName('Alayza');
        $entity->setEmail('malayza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Enrique');
        $entity->setLastName('Larrabure');
        $entity->setEmail('elarrabure@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('David');
        $entity->setLastName('Wong');
        $entity->setEmail('dwong@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('xxxxx');
        $entity->setLastName('xxxxxx');
        $entity->setEmail('xxxxxxx@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Mario');
        $entity->setLastName('Mujica');
        $entity->setEmail('mmujica@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Raimundo');
        $entity->setLastName('Morales');
        $entity->setEmail('rmorales@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alvaro');
        $entity->setLastName('Garcia');
        $entity->setEmail('agarcia@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Miguel');
        $entity->setLastName('Cruchaga');
        $entity->setEmail('mcruchaga@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Enrique');
        $entity->setLastName('Quevedo');
        $entity->setEmail('equevedo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Felipe');
        $entity->setLastName('Bentin');
        $entity->setEmail('fbentin@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Oscar');
        $entity->setLastName('Tendler');
        $entity->setEmail('otendler@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Pedro');
        $entity->setLastName('Rubio');
        $entity->setEmail('prubio@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jaime');
        $entity->setLastName('Pardo');
        $entity->setEmail('jpardo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Javier');
        $entity->setLastName('Otero');
        $entity->setEmail('jotero@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Juan');
        $entity->setLastName('Quispe');
        $entity->setEmail('jquispe@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Augusto');
        $entity->setLastName('Perez');
        $entity->setEmail('aperez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Manuel');
        $entity->setLastName('Velarde');
        $entity->setEmail('mvelarde@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Miguel');
        $entity->setLastName('Puga');
        $entity->setEmail('mpuga@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jesus');
        $entity->setLastName('Martinez');
        $entity->setEmail('jmartinez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jorge');
        $entity->setLastName('Silva');
        $entity->setEmail('jsilva@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Antonio');
        $entity->setLastName('Leon');
        $entity->setEmail('aleon@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Manuel');
        $entity->setLastName('Cueto');
        $entity->setEmail('mcueto@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Elias');
        $entity->setLastName('Peral');
        $entity->setEmail('eperal@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Lidia');
        $entity->setLastName('Medina');
        $entity->setEmail('lmedina@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Silvia');
        $entity->setLastName('Lazo');
        $entity->setEmail('slazo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Veronica');
        $entity->setLastName('Lopez');
        $entity->setEmail('vlopez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ernesto');
        $entity->setLastName('Ramos');
        $entity->setEmail('eramos@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Bernardo');
        $entity->setLastName('Llanos');
        $entity->setEmail('bllanos@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Martha');
        $entity->setLastName('Rodriguez');
        $entity->setEmail('mrodriguez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Carlos');
        $entity->setLastName('Belgrano');
        $entity->setEmail('cbelgrano@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jacobo');
        $entity->setLastName('Rebaza');
        $entity->setEmail('jrebaza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Guillermo');
        $entity->setLastName('Ramirez');
        $entity->setEmail('gramirez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Estuardo');
        $entity->setLastName('Cavenago');
        $entity->setEmail('ecavenago@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alberto');
        $entity->setLastName('Torres');
        $entity->setEmail('atorres@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Manuel');
        $entity->setLastName('Castro');
        $entity->setEmail('mcastro@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alfonso');
        $entity->setLastName('Espinoza');
        $entity->setEmail('aespinoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Vicente');
        $entity->setLastName('Mamani');
        $entity->setEmail('vmamani@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); //44
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Elena');
        $entity->setLastName('Ruiz');
        $entity->setEmail('eruiz@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Agustin');
        $entity->setLastName('Reyes');
        $entity->setEmail('areyes@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Claudia');
        $entity->setLastName('León');
        $entity->setEmail('cleon@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Eulogio');
        $entity->setLastName('Gutiérrez');
        $entity->setEmail('egutierrez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Blanca');
        $entity->setLastName('Huamán');
        $entity->setEmail('bhuaman@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Rodolfo');
        $entity->setLastName('Vásquez');
        $entity->setEmail('rvasquez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User(); // 50
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Salvador');
        $entity->setLastName('Espinoza');
        $entity->setEmail('sespinoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Santiago');
        $entity->setLastName('Sánchez');
        $entity->setEmail('ssanchez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('David');
        $entity->setLastName('Gonzáles');
        $entity->setEmail('dgonzales@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Gerardo');
        $entity->setLastName('Rodríguez');
        $entity->setEmail('grodriguez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Raimundo');
        $entity->setLastName('Chávez');
        $entity->setEmail('rchavez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Agustin');
        $entity->setLastName('Díaz');
        $entity->setEmail('adiaz@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Marcela');
        $entity->setLastName('Mendoza');
        $entity->setEmail('mmendoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Olivia');
        $entity->setLastName('Castillo');
        $entity->setEmail('ocastillo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Amada');
        $entity->setLastName('Romero');
        $entity->setEmail('aromero@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Max');
        $entity->setLastName('Fernandez');
        $entity->setEmail('mfernandez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jacobo');
        $entity->setLastName('Vargas');
        $entity->setEmail('mvargas@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('11112222');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Manuel');
        $entity->setLastName('Colmenares');
        $entity->setEmail('mcolmenares@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        /**
         * CANILLITAS
         */



        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}


/*


        $plantaCentroPando = $this->getReference('client-1');
        $client2 = $this->getReference('client-2');

        $profileAdmin = $this->getReference('profile-admin');

        $entity = new User();
        $entity->setDni('12345688');
        $entity->setPassword('123');
        $entity->setName('Alfredo');
        $entity->setLastName('Bringas');
        $entity->setEmail('abringas@' . $this->applicationUrl);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->setClient($plantaCentroPando);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('12345677');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ricardo');
        $entity->setLastName('Masias');
        $entity->setEmail('agarcia-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $entity->setClient($plantaCentroPando);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('87654321');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Albert');
        $entity->setLastName('Einstein');
        $entity->setEmail('aeinstein-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($plantaCentroPando);
        $entity->setProfile($profileAdmin);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('88889999');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('22334455');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);


        $manager->flush();
 */