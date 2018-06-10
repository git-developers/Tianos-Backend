<?php

declare(strict_types=1);

namespace Bundle\RouteBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Route\Repository\RouteRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Component\OneToMany\Repository\OneToManyRightRepositoryInterface;

class RouteRepository extends TianosEntityRepository
    implements RouteRepositoryInterface, OneToManyLeftRepositoryInterface, OneToManyRightRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.id = :id AND
            route.isActive = :active
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
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.isActive = :active
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

    public function deleteAssociativeTableById($id): bool
    {
//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;

        $em = $this->getEntityManager();
        $sql = "DELETE FROM route_has_point_of_sale WHERE route_id = :id;";
        $params = array('id' => $id);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }

    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.id = :id AND
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.name LIKE :q AND
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT route
            FROM RouteBundle:Route route
            WHERE
            route.name LIKE :q AND
            route.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }
}
