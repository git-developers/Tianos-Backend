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

        $roleUserCreate = $this->getReference('role-user-create');
        $roleUserEdit = $this->getReference('role-user-edit');
        $roleUserView = $this->getReference('role-user-view');
        $roleUserDelete = $this->getReference('role-user-delete');

        $entity = new Profile();
        $entity->setName(Profile::ADMIN);
        $entity->addRole($roleUserCreate);
        $entity->addRole($roleUserEdit);
        $entity->addRole($roleUserView);
        $entity->addRole($roleUserDelete);
        $manager->persist($entity);
        $this->addReference('profile-admin', $entity);


        $entity = new Profile();
        $entity->setName('Jefe de Administración Comercial');
        $manager->persist($entity);
        $this->addReference('profile-jefe-administracion-comercial', $entity);

        $entity = new Profile();
        $entity->setName('Asistente de Distribución y Transporte');
        $manager->persist($entity);
        $this->addReference('profile-asistente-distribucion-transporte', $entity);

        $entity = new Profile();
        $entity->setName('Gerente de ventas');
        $manager->persist($entity);
        $this->addReference('profile-gerente-ventas', $entity);

        $entity = new Profile();
        $entity->setName('Supervisor de venta');
        $manager->persist($entity);
        $this->addReference('profile-supervisor-venta', $entity);

        $entity = new Profile();
        $entity->setName('Jefe de venta');
        $manager->persist($entity);
        $this->addReference('profile-jefe-venta', $entity);

        $entity = new Profile();
        $entity->setName('Jefe de almacén');
        $manager->persist($entity);
        $this->addReference('profile-jefe-almacen', $entity);

        $entity = new Profile();
        $entity->setName('Transportista');
        $manager->persist($entity);
        $this->addReference('profile-transportista', $entity);

        $entity = new Profile();
        $entity->setName('Distribuidor');
        $manager->persist($entity);
        $this->addReference('profile-distribuidor', $entity);

        $entity = new Profile();
        $entity->setName('Canillita');
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