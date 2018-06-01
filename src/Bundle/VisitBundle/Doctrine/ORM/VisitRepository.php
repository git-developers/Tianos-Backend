<?php

declare(strict_types=1);

namespace Bundle\VisitBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Visit\Repository\VisitRepositoryInterface;

class VisitRepository extends TianosEntityRepository implements VisitRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findByUuid($uuid)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT visit
            FROM VisitBundle:Visit visit
            WHERE
            visit.uuid = :uuid
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('uuid', $uuid);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT visit
            FROM VisitBundle:Visit visit
            WHERE
            visit.id = :id AND
            visit.isActive = :active
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
            SELECT visit
            FROM VisitBundle:Visit visit
            WHERE
            visit.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();

//        return $this->createQueryBuilder('o')
//            ->select('o')
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
