<?php

declare(strict_types=1);

namespace Bundle\ProfileBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Profile\Repository\ProfileRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;

class ProfileRepository extends TianosEntityRepository
    implements ProfileRepositoryInterface, OneToManyLeftRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableById($id): bool
    {

        $em = $this->getEntityManager();

//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;


        $sql = "DELETE FROM profile_has_role WHERE profile_id = :id;";
        $params = array('id' => $id);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;

    }

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.id = :id AND
            profile.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.id = :id AND
            profile.isActive = :active
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
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.isActive = :active
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
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.name LIKE :q AND
            profile.isActive = :active
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
            SELECT profile
            FROM ProfileBundle:Profile profile
            WHERE
            profile.isActive = :active
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
}
