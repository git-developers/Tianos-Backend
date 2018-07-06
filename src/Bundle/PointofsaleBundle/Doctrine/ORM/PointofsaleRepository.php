<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Pointofsale\Repository\PointofsaleRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Component\OneToMany\Repository\OneToManyRightRepositoryInterface;

class PointofsaleRepository extends TianosEntityRepository
    implements
    PointofsaleRepositoryInterface, OneToManyLeftRepositoryInterface, OneToManyRightRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function pdvHasProductLastWeekCount()
    {

        $now = new \DateTime('now');
        $now->sub(new \DateInterval('P7D'));

        $nextSevenDays = new \DatePeriod(
            $now, // Start date of the period
            new \DateInterval('P1D'), // Define the intervals as Periods of 1 Day
            6 // Apply the interval 6 times on top of the starting date
        );

        $count = [];
        $em = $this->getEntityManager();

        foreach ($nextSevenDays as $key => $day)
        {
            $sql = "SELECT SUM(quantity) AS quantity FROM point_of_sale_has_product WHERE SUBSTRING(created_at, 1, 10) = :today_date;";
            $params = ['today_date' => $day->format('Y-m-d')];

            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute($params);

            $count[] = $stmt->fetchColumn();
        }

        return $count;
    }

    /**
     * {@inheritdoc}
     */
    public function pdvHasProductCount()
    {
        $date = new \DateTime("now");
        $date->sub(new \DateInterval('P1D'));
        $todayDate = $date->format('Y-m-d');

        $em = $this->getEntityManager();
        $sql = "SELECT SUM(quantity) AS quantity FROM point_of_sale_has_product WHERE SUBSTRING(created_at, 1, 10) = :today_date;";
        $params = ['today_date' => $todayDate];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        return ($stmt->fetchColumn() > 0) ? $stmt->fetchColumn() : 0;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAssociativeTableById($id): bool
    {
//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;

        $em = $this->getEntityManager();
        $sql = "DELETE FROM point_of_sale_has_user WHERE point_of_sale_id = :id;";
        $params = ['id' => $id];

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.name LIKE :q AND
            pointofsale.isActive = :active
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
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function findAllObjects()
    {
        return $this->createQueryBuilder('a')
            ->where('a.isActive = :active')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.id = :id AND
            pointofsale.isActive = :active
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
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.id = :id AND
            pointofsale.isActive = :active
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
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.isActive = :active
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

    /**
     * {@inheritdoc}
     */
    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT pointofsale
            FROM PointofsaleBundle:Pointofsale pointofsale
            WHERE
            pointofsale.name LIKE :q AND
            pointofsale.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }
}
