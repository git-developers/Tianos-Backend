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


        $dniArray = [];
        for ($i = 0; $i <= 100; $i++){
            $dniArray = 11;
        }


//        echo "POLLO:: <pre>";
//        print_r($dniArray);
//        exit;





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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('34252311');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Carlos');
        $entity->setLastName('Maldonado');
        $entity->setEmail('cmaldonado@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('99887736');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Hector');
        $entity->setLastName('Ruiz');
        $entity->setEmail('hruiz@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645346');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jorge');
        $entity->setLastName('Linares');
        $entity->setEmail('jlinares@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645347');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Salvador');
        $entity->setLastName('Garcia');
        $entity->setEmail('sgarcia@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645348');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Gilberto');
        $entity->setLastName('Campos');
        $entity->setEmail('gcampos@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645349');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Javier');
        $entity->setLastName('Palomares');
        $entity->setEmail('jpalomares@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645342');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Juan');
        $entity->setLastName('Olivera');
        $entity->setEmail('jolivera@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileTransportista);
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Barranco
        $entity->setDni('63738499');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Fernandez');
        $entity->setLastName('Miranda');
        $entity->setEmail('fmiranda@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Chorrillos
        $entity->setDni('45637482');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Florentino');
        $entity->setLastName('Paucar');
        $entity->setEmail('fpaucar@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // El Porvenir
        $entity->setDni('34568498');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Felix');
        $entity->setLastName('Moreno');
        $entity->setEmail('fmoreno@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // La Molina
        $entity->setDni('98574657');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Prospero');
        $entity->setLastName('Rivera');
        $entity->setEmail('privera@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Lurigancho
        $entity->setDni('34344556');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ruth');
        $entity->setLastName('Aguirre');
        $entity->setEmail('raguirre@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Magdalena
        $entity->setDni('76523423');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jimenez');
        $entity->setLastName('Catalina');
        $entity->setEmail('jcatalina@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Miraflores
        $entity->setDni('45362374');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Priscila');
        $entity->setLastName('Espinoza');
        $entity->setEmail('pespinoza@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Plaza Grau
        $entity->setDni('76542398');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Elisa');
        $entity->setLastName('Mendez');
        $entity->setEmail('emendez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Puente Piedra II
        $entity->setDni('55883245');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Faustino');
        $entity->setLastName('Sanchez');
        $entity->setEmail('fsanchez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Salamanca
        $entity->setDni('55434538');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Martha');
        $entity->setLastName('Trujillo');
        $entity->setEmail('mtrujillo@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // San Borja
        $entity->setDni('65287633');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Marcelina');
        $entity->setLastName('Rojas');
        $entity->setEmail('mrojas@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // San Martin De Porres
        $entity->setDni('65432789');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Maria');
        $entity->setLastName('Perez');
        $entity->setEmail('mperez@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Surquillo
        $entity->setDni('63523498');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Baseliza');
        $entity->setLastName('Marin');
        $entity->setEmail('bmarin@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Ventanilla II
        $entity->setDni('34527832');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Edilberto');
        $entity->setLastName('Sarmiento');
        $entity->setEmail('esarmiento@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Zarumilla
        $entity->setDni('76534562');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jose');
        $entity->setLastName('Flores');
        $entity->setEmail('jflores@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Tomas Marsano
        $entity->setDni('37482392');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Nestor');
        $entity->setLastName('Flores');
        $entity->setEmail('nflores@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Chacarilla
        $entity->setDni('57363723');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Alejandra');
        $entity->setLastName('Parco');
        $entity->setEmail('aparco@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Comas
        $entity->setDni('58693784');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Enrique');
        $entity->setLastName('Leon');
        $entity->setEmail('eleon@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User(); // Plaza Mexico
        $entity->setDni('25436423');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Henry');
        $entity->setLastName('Patazca');
        $entity->setEmail('hpatazca@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileDistribuidor);
        $entity->setEnabled(true);
        $manager->persist($entity);
        /**
         * DISTRIBUIDORES
         */



        /**
         * CANILLITAS
         */
        $entity = new User();
        $entity->setDni('23748239');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Pedro');
        $entity->setLastName('Zavaleta');
        $entity->setEmail('pzavaleta@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('22334465');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Carlos');
        $entity->setLastName('Gonzales');
        $entity->setEmail('cgonzales@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('45887766');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Hector');
        $entity->setLastName('Galvan');
        $entity->setEmail('hgalvan@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('74645332');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Jorge');
        $entity->setLastName('Castaña');
        $entity->setEmail('jcastaña@' . $this->applicationUrl);
        $entity->setClient($clientePlantaCentroPando);
        $entity->setProfile($profileCanillita);
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
        $entity->setClient($plantaCentroPando);
        $entity->setProfile($profileAdmin);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('12345677');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Ricardo');
        $entity->setLastName('Masias');
        $entity->setEmail('agarcia-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setEnabled(true);
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
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('88889999');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Steve');
        $entity->setLastName('Jobs');
        $entity->setEmail('sjobs-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('22334455');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Bill');
        $entity->setLastName('Gates');
        $entity->setEmail('bgates-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setEnabled(true);
        $manager->persist($entity);

        $entity = new User();
        $entity->setDni('99887766');
        $entity->setPassword('1q2w3e4r');
        $entity->setName('Isaac');
        $entity->setLastName('Newton');
        $entity->setEmail('inewton-' . uniqid() . '@' . $this->applicationUrl);
        $entity->setClient($client2);
        $entity->setProfile($profileAdmin);
        $entity->setEnabled(true);
        $manager->persist($entity);


        $manager->flush();
 */