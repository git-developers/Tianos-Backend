<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bundle\ProfileBundle\Entity\Profile;

class Load_3_ProfileData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $dateCreatedAt = "2018-05-11";

        $roleUserCreate = $this->getReference('role-user-create');
        $roleUserEdit = $this->getReference('role-user-edit');
        $roleUserView = $this->getReference('role-user-view');
        $roleUserDelete = $this->getReference('role-user-delete');


        /**
         * CANONICAL ROLES
         */
        $roleCanonicalJefeAdministracionComercial = $this->getReference('role-canonical-jefe-administracion-comercial');
        $roleCanonicalAsistenteDistribucionTransporte = $this->getReference('role-canonical-asistente-distribucion-transporte');
        $roleCanonicalGerenteVentas = $this->getReference('role-canonical-gerente-ventas');
        $roleCanonicalSupervisorVenta = $this->getReference('role-canonical-supervisor-venta');
        $roleCanonicalJefeVenta = $this->getReference('role-canonical-jefe-venta');
        $roleCanonicalJefeAlmacen = $this->getReference('role-canonical-jefe-almacen');
        $roleCanonicalTransportista = $this->getReference('role-canonical-transportista');
        $roleCanonicalDistribuidor = $this->getReference('role-canonical-distribuidor');
        $roleCanonicalCanillita = $this->getReference('role-canonical-canillita');



        $entity = new Profile();
        $entity->setName(Profile::ADMIN);
        $entity->setNameCanonical(Profile::ADMIN);
        $entity->addRole($roleUserCreate);
        $entity->addRole($roleUserEdit);
        $entity->addRole($roleUserView);
        $entity->addRole($roleUserDelete);

        $entity->addRole($roleCanonicalJefeAdministracionComercial);
        $entity->addRole($roleCanonicalAsistenteDistribucionTransporte);
        $entity->addRole($roleCanonicalGerenteVentas);
        $entity->addRole($roleCanonicalSupervisorVenta);
        $entity->addRole($roleCanonicalJefeVenta);
        $entity->addRole($roleCanonicalJefeAlmacen);
        $entity->addRole($roleCanonicalTransportista);
//        $entity->addRole($roleCanonicalDistribuidor);
        $entity->addRole($roleCanonicalCanillita);

        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-admin', $entity);


        $entity = new Profile();
        $entity->setName('Jefe de Administración Comercial');
        $entity->setNameCanonical(Profile::JEFE_DE_ADMINISTRACION_COMERCIAL);
        $entity->addRole($roleCanonicalJefeAdministracionComercial);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-jefe-administracion-comercial', $entity);

        $entity = new Profile();
        $entity->setName('Asistente de Distribución y Transporte');
        $entity->setNameCanonical(Profile::ASISTENTE_DE_DISTRIBUCION_TRANSPORTE);
        $entity->addRole($roleCanonicalAsistenteDistribucionTransporte);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-asistente-distribucion-transporte', $entity);

        $entity = new Profile();
        $entity->setName('Gerente de ventas');
        $entity->setNameCanonical(Profile::GERENTE_DE_VENTAS);
        $entity->addRole($roleCanonicalGerenteVentas);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-gerente-ventas', $entity);

        $entity = new Profile();
        $entity->setName('Supervisor de venta');
        $entity->setNameCanonical(Profile::SUPERVISOR_DE_VENTA);
        $entity->addRole($roleCanonicalSupervisorVenta);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-supervisor-venta', $entity);

        $entity = new Profile();
        $entity->setName('Jefe de venta');
        $entity->setNameCanonical(Profile::JEFE_DE_VENTA);
        $entity->addRole($roleCanonicalJefeVenta);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-jefe-venta', $entity);

        $entity = new Profile();
        $entity->setName('Jefe de almacén');
        $entity->setNameCanonical(Profile::JEFE_DE_ALMACEN);
        $entity->addRole($roleCanonicalJefeAlmacen);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-jefe-almacen', $entity);

        $entity = new Profile();
        $entity->setName('Transportista');
        $entity->setNameCanonical(Profile::TRANSPORTISTA);
        $entity->addRole($roleCanonicalTransportista);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-transportista', $entity);

        $entity = new Profile();
        $entity->setName('Distribuidor');
        $entity->setNameCanonical(Profile::DISTRIBUIDOR);
        $entity->addRole($roleCanonicalDistribuidor);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-distribuidor', $entity);

        $entity = new Profile();
        $entity->setName('Canillita');
        $entity->setNameCanonical(Profile::CANILLITA);
        $entity->addRole($roleCanonicalCanillita);
        $entity->setCreatedAt(new \DateTime($dateCreatedAt));
        $manager->persist($entity);
        $this->addReference('profile-canillita', $entity);



//        $entity = new Profile();
//        $entity->setName(Profile::GUEST);
//        $manager->persist($entity);


        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}