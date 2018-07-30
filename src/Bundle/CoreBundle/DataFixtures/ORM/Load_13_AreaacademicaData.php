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
        $universityUtp = $this->getReference('university-utp');
        $universityUrp = $this->getReference('university-urp');
        $universityUpc = $this->getReference('university-upc');
        $universityUnmsm = $this->getReference('university-unmsm');
        $universityUnfv = $this->getReference('university-unfv');
        $universityUsil = $this->getReference('university-usil');
        $universityUnife = $this->getReference('university-unife');
        $universityUl = $this->getReference('university-ul');
        $universityUdep = $this->getReference('university-udep');
        $universityUsmp = $this->getReference('university-usmp');
        $universityUp = $this->getReference('university-up');
        $universityUe = $this->getReference('university-ue');
        $universityPucp = $this->getReference('university-pucp');
        $universityUap = $this->getReference('university-uap');
        $universityUcv = $this->getReference('university-ucv');


        $entity = new Areaacademica();
        $entity->setCode('111');
        $entity->setName('Ciencias Básicas');
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $this->addReference('areaacademica-ciencia-basica', $entity);

        $entity = new Areaacademica();
        $entity->setCode('222');
        $entity->setName('Humanidades');
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $this->addReference('areaacademica-humanidades', $entity);

        $entity = new Areaacademica();
        $entity->setCode('333');
        $entity->setName('Ciencias Sociales');
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $this->addReference('areaacademica-sociales', $entity);

        $entity = new Areaacademica();
        $entity->setCode('444');
        $entity->setName('Ciencias de la Salud');
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $this->addReference('areaacademica-salud', $entity);

        $entity = new Areaacademica();
        $entity->setCode('555');
        $entity->setName('Ingeniería');
        $universityUni->addAreaacademica($entity);
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $manager->persist($universityUni);
        $this->addReference('areaacademica-ingenieria', $entity);

        $entity = new Areaacademica();
        $entity->setCode('666');
        $entity->setName('Económico');
        $universityUni->addAreaacademica($entity);
        $universityUtp->addAreaacademica($entity);
        $universityUrp->addAreaacademica($entity);
        $universityUpc->addAreaacademica($entity);
        $universityUnmsm->addAreaacademica($entity);
        $universityUnfv->addAreaacademica($entity);
        $universityUsil->addAreaacademica($entity);
        $universityUnife->addAreaacademica($entity);
        $universityUl->addAreaacademica($entity);
        $universityUdep->addAreaacademica($entity);
        $universityUsmp->addAreaacademica($entity);
        $universityUp->addAreaacademica($entity);
        $universityUe->addAreaacademica($entity);
        $universityPucp->addAreaacademica($entity);
        $universityUap->addAreaacademica($entity);
        $universityUcv->addAreaacademica($entity);
        $manager->persist($entity);
        $manager->persist($universityUni);
        $manager->persist($universityUtp);
        $manager->persist($universityUrp);
        $manager->persist($universityUpc);
        $manager->persist($universityUnmsm);
        $manager->persist($universityUnfv);
        $manager->persist($universityUsil);
        $manager->persist($universityUnife);
        $manager->persist($universityUl);
        $manager->persist($universityUdep);
        $manager->persist($universityUsmp);
        $manager->persist($universityUp);
        $manager->persist($universityUe);
        $manager->persist($universityPucp);
        $manager->persist($universityUap);
        $manager->persist($universityUcv);
        $this->addReference('areaacademica-economico', $entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 13;
    }
}