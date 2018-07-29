<?php

declare(strict_types=1);

namespace Bundle\AreaacademicaBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Areaacademica\Repository\AreaacademicaRepositoryInterface;

class AreaacademicaRepository extends TianosEntityRepository implements AreaacademicaRepositoryInterface
{

//    /**
//     * {@inheritdoc}
//     */
//    public function associative($boxOneId, $boxTwoId): array
//    {
//        $em = $this->getEntityManager();
//        $dql = "
//            SELECT areaacademica
//            FROM AreaacademicaBundle:Areaacademica areaacademica
//            WHERE
//            areaacademica.name LIKE :q AND
//            areaacademica.isActive = :active
//            ";
//
//        $query = $em->createQuery($dql);
//        $query->setParameter('active', 1);
//        $query->setParameter('q', '%' . $q . '%');
//        $query->setFirstResult($offset);
//        $query->setMaxResults($limit);
//
//        return $query->getResult();
//    }

    /**
     * {@inheritdoc}
     */
    public function searchBox($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT areaacademica
            FROM AreaacademicaBundle:Areaacademica areaacademica
            WHERE
            areaacademica.name LIKE :q AND
            areaacademica.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT areaacademica
            FROM AreaacademicaBundle:Areaacademica areaacademica
            WHERE
            areaacademica.id = :id AND
            areaacademica.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT areaacademica
            FROM AreaacademicaBundle:Areaacademica areaacademica
            WHERE
            areaacademica.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();

//        return $this->createQueryBuilder('o')
//            ->select('o.id, o.code, o.name, o.createdAt')
//            ->andWhere('o.isActive = :active')
//            ->setParameter('active', 1)
//            ->getQuery()
//            ->getResult()
//            ;
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name = :name')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }
}
