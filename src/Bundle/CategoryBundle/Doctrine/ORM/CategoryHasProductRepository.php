<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Doctrine\ORM;

use Component\Category\Model\CategoryInterface;
use Component\Category\Repository\CategoryRepositoryInterface;
use Component\TreeOneToMany\Repository\TreeOneToManyLeftRepositoryInterface;
use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Bundle\CategoryBundle\Entity\CategoryHasProduct;

class CategoryHasProductRepository extends TianosEntityRepository
    implements CategoryRepositoryInterface, TreeOneToManyLeftRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function treeOneToManyLeft($idLeft): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT categoryHasProduct
            FROM CategoryBundle:CategoryHasProduct categoryHasProduct
            WHERE
            categoryHasProduct.category = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $idLeft);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableById($id): bool
    {
        $em = $this->getEntityManager();
        $statement = $em->getConnection()->prepare('DELETE FROM category_has_product WHERE category_id = :id;');
        $statement->bindValue('id', $id);

        return $statement->execute();



//        $em = $this->getEntityManager();
//        return $em->getConnection()
//                    ->prepare('DELETE FROM category_has_product WHERE category_id = :id;')
//                    ->bindValue('id', $id)
//                    ->execute()
//        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneLeftById($id): ?CategoryHasProduct
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT categoryHasProduct, category
            FROM CategoryBundle:CategoryHasProduct categoryHasProduct
            INNER JOIN categoryHasProduct.category category
            WHERE
            category.id = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneRightById($id): ?CategoryHasProduct
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT categoryHasProduct, product
            FROM CategoryBundle:CategoryHasProduct categoryHasProduct
            INNER JOIN categoryHasProduct.product product
            WHERE
            product.id = :id
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {

    }

    public function findAll(): array
    {
        // TODO: Implement findAllParents() method.
    }

    public function findAllParents(): array
    {
        // TODO: Implement findAllParents() method.
    }

    public function findAllByParent($parent): array
    {
        // TODO: Implement findAllByParent() method.
    }

    public function findByName(string $name, string $locale): array
    {
        // TODO: Implement findByName() method.
    }

    public function findByNamePart(string $phrase, string $locale): array
    {
        // TODO: Implement findByNamePart() method.
    }


    public function deleteAssociativeTableLeft($id): bool
    {
        // TODO: Implement deleteAssociativeTableLeft() method.
    }
}
