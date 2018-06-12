<?php

declare(strict_types=1);

namespace Bundle\OrderinBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Orderin\Repository\OrderinRepositoryInterface;

class OrderRepository extends TianosEntityRepository implements OrderinRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findObjectUpsert($pointOfSaleId, $userId, $orderDate, $productId)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT order_
            FROM OrderinBundle:Order order_
            WHERE
            order_.pointOfSale = :pointOfSaleId AND
            order_.user = :userId AND
            order_.orderDate = :orderDate AND
            order_.product = :productId AND
            order_.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pointOfSaleId', $pointOfSaleId);
        $query->setParameter('userId', $userId);
        $query->setParameter('orderDate', $orderDate);
        $query->setParameter('productId', $productId);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findObjectCenterSelectItem($pointOfSaleId, $userId, $orderDate)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT order_
            FROM OrderinBundle:Order order_
            WHERE
            order_.pointOfSale = :pointOfSaleId AND
            order_.user = :userId AND
            SUBSTRING(order_.orderDate, 1, 10) = :orderDate AND
            order_.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pointOfSaleId', $pointOfSaleId);
        $query->setParameter('userId', $userId);
        $query->setParameter('orderDate', $orderDate);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT order_
            FROM OrderinBundle:Order_ order_
            WHERE
            order_.id = :id AND
            order_.isActive = :active
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
            SELECT order_
            FROM OrderinBundle:Order_ order_
            WHERE
            order_.isActive = :active
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
