<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Doctrine\ORM;

use Component\Product\Repository\ProductRepositoryInterface;
use Component\TreeOneToMany\Repository\TreeOneToManyRightRepositoryInterface;
use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class ProductRepository extends TianosEntityRepository
    implements ProductRepositoryInterface, TreeOneToManyRightRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function productCount()
    {
        $date = new \DateTime("now");
        $date->sub(new \DateInterval('P1D'));
        $todayDate = $date->format('Y-m-d');

        $em = $this->getEntityManager();
        $sql = "SELECT count(id) AS ID FROM product WHERE is_active = :isActive;";
        $params = array('isActive' => 1);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchColumn();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.name LIKE :q AND
            product.isActive = :active
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
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
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
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.id = :id AND
            product.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
//    public function find($id)
//    {
//        return $this->createQueryBuilder('o')
//            ->select('o.id, o.code, o.name, o.createdAt')
//            ->andWhere('o.isActive = :active')
//            ->andWhere('o.id = :id')
//            ->setParameter('active', 1)
//            ->setParameter('id', $id)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
//    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT product
            FROM ProductBundle:Product product
            WHERE
            product.isActive = :active
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
