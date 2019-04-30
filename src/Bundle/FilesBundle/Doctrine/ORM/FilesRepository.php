<?php

declare(strict_types=1);

namespace Bundle\FilesBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Files\Repository\FilesRepositoryInterface;

class FilesRepository extends TianosEntityRepository implements FilesRepositoryInterface
{
	
	/**
	 * {@inheritdoc}
	 */
	public function findAllFilesByPk(int $pkFileItem)
	{
		$em = $this->getEntityManager();
		$dql = "
            SELECT files
            FROM FilesBundle:Files files
            WHERE
            files.isActive = :active AND
            files.pkFileItem = :pkFileItem
            ";
		
		$query = $em->createQuery($dql);
		$query->setParameter('active', 1);
		$query->setParameter('pkFileItem', $pkFileItem);
		
		return $query->getResult();
	}

    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files
            FROM FilesBundle:Files files
            WHERE
            files.id = :id AND
            files.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByPk($pkFileItem, $fileType)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files
            FROM FilesBundle:Files files
            WHERE
            files.isActive = :active AND
            files.fileType = :fileType AND
            files.pkFileItem = :pkFileItem
            ORDER BY files.id DESC
            ";

        $query = $em->createQuery($dql);
        $query->setMaxResults(1);
        $query->setParameter('active', 1);
        $query->setParameter('fileType', $fileType);
        $query->setParameter('pkFileItem', $pkFileItem);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files
            FROM FilesBundle:Files files
            WHERE
            files.isActive = :active
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
