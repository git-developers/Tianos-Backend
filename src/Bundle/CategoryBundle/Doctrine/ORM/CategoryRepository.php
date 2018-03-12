<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Doctrine\ORM;

use Component\Category\Repository\CategoryRepositoryInterface;
use Component\TreeOneToMany\Repository\TreeOneToManyLeftRepositoryInterface;
use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class CategoryRepository extends TianosEntityRepository
    implements CategoryRepositoryInterface, TreeOneToManyLeftRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableById($id): bool
    {
        $em = $this->getEntityManager();
        $statement = $em->getConnection()->prepare('DELETE FROM category_has_product WHERE category_id = :id;');
        $statement->bindValue('id', $id);

        return $statement->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.id, o.code, o.name, o.createdAt')
            ->andWhere('o.isActive = :active')
            ->setParameter('active', 1)
            ->getQuery()
        ;

        $qb->setFirstResult($offset);
        $qb->setMaxResults($limit);

        return $qb->getResult();
    }

    public function findAllParents(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT parent
            FROM CategoryBundle:Category parent
            WHERE
            parent.isActive = :active AND
            parent.category IS NULL
            ORDER BY parent.id DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();
    }

    public function findAllByParent($parent): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT child
            FROM CategoryBundle:Category child
            WHERE
            child.isActive = :active AND
            child.category = :parent
            ORDER BY child.id DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('parent', $parent);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT category
            FROM CategoryBundle:Category category
            WHERE
            category.id = :id AND
            category.isActive = :active
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
    public function findAllObjects()
    {
        return $this->createQueryBuilder('o')
            ->where('o.isActive = :active')
            ->orderBy('o.id', 'ASC')
            ->setParameter('active', true)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id, o.code, o.name, o.createdAt')
            ->andWhere('o.isActive = :active')
            ->setParameter('active', 1)
            ->getQuery()
            ->getResult()
            ;
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
