<?php

//declare(strict_types=1);

namespace Bundle\ProductBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository;
use Component\Product\Repository\ProductRepositoryInterface;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('o')
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
