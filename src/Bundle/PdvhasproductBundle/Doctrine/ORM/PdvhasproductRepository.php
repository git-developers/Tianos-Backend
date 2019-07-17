<?php

declare(strict_types=1);

namespace Bundle\PdvhasproductBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Pdvhasproduct\Repository\PdvhasproductRepositoryInterface;

class PdvhasproductRepository extends TianosEntityRepository implements PdvhasproductRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findByPointOfSale($pointOfSaleId, $dateStart, $dateEnd)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdvhasproduct
            FROM PdvhasproductBundle:Pdvhasproduct pdvhasproduct
            WHERE
            pdvhasproduct.pointOfSale = :pointOfSaleId AND
            (SUBSTRING(pdvhasproduct.createdAt, 1, 10) BETWEEN :dateStart AND :dateEnd) AND
            pdvhasproduct.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pointOfSaleId', $pointOfSaleId);
        $query->setParameter('dateStart', $dateStart);
        $query->setParameter('dateEnd', $dateEnd);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pdvhasproduct, user_
            FROM PdvhasproductBundle:Pdvhasproduct pdvhasproduct
            INNER JOIN pdvhasproduct.user user_
            WHERE
            pdvhasproduct.id = :id AND
            pdvhasproduct.isActive = :active
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
            SELECT pdvhasproduct, user_
            FROM PdvhasproductBundle:Pdvhasproduct pdvhasproduct
            INNER JOIN pdvhasproduct.user user_
            WHERE
            pdvhasproduct.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
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
