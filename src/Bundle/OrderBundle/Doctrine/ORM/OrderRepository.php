<?php

declare(strict_types=1);

namespace Bundle\OrderBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Order\Repository\OrderRepositoryInterface;

class OrderRepository extends TianosEntityRepository implements OrderRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findObjectUpsert($pointOfSaleId, $userId, $orderDate, $productId, $type)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT order_
            FROM OrderBundle:Order order_
            WHERE
            order_.pointOfSale = :pointOfSaleId AND
            order_.user = :userId AND
            order_.orderDate = :orderDate AND
            order_.product = :productId AND
            order_.type = :type_ AND
            order_.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pointOfSaleId', $pointOfSaleId);
        $query->setParameter('userId', $userId);
        $query->setParameter('orderDate', $orderDate);
        $query->setParameter('productId', $productId);
        $query->setParameter('type_', $type);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findObjectCenterSelectItem($pointOfSaleId, $userId, $orderDate, $type)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT order_
            FROM OrderBundle:Order order_
            WHERE
            order_.pointOfSale = :pointOfSaleId AND
            order_.user = :userId AND
            SUBSTRING(order_.orderDate, 1, 10) = :orderDate AND
            order_.type = :type_ AND
            order_.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('pointOfSaleId', $pointOfSaleId);
        $query->setParameter('userId', $userId);
        $query->setParameter('orderDate', $orderDate);
        $query->setParameter('type_', $type);

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
            FROM OrderBundle:Order_ order_
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
            FROM OrderBundle:Order_ order_
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
