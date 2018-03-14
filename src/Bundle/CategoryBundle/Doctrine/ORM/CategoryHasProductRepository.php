<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Doctrine\ORM;

use Component\Category\Model\CategoryInterface;
use Component\Category\Repository\CategoryRepositoryInterface;
use Component\TreeOneToMany\Repository\TreeOneToManyLeftRepositoryInterface;
use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;

class CategoryHasProductRepository extends TianosEntityRepository implements CategoryRepositoryInterface
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


}
