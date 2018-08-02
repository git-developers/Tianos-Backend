<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Google\Repository\GoogleRepositoryInterface;

class GoogleDriveFileRepository extends TianosEntityRepository implements GoogleRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findMisArchivos($userId): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google, user_
            FROM GoogleBundle:GoogleDriveFile google
            INNER JOIN google.user user_
            WHERE
            google.isActive = :active AND
            user_.id = :userId
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('userId', $userId);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFile google
            WHERE
            google.id = :id AND
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll($maxResults = 30): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT google
            FROM GoogleBundle:GoogleDriveFile google
            WHERE
            google.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setMaxResults($maxResults);

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
