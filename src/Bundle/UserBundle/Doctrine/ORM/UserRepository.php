<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Doctrine\ORM;

use Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Component\User\Model\UserInterface;
use Component\User\Repository\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimit($offset = 0, $limit = 50): array
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.id, o.name, o.createdAt')
            ->andWhere('o.enabled = :active')
            ->setParameter('active', 1)
            ->getQuery()
        ;

        $qb->setFirstResult($offset);
        $qb->setMaxResults($limit);

        return $qb->getResult();
    }

    public function findAllObjects()
    {

        return $this->createQueryBuilder('a')
            ->where('a.enabled = :active')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ;

//        echo "POLLO:: <pre>";
//        print_r($eeee->getDQL());
//        exit;

    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);

        return $query->getResult();



//        return $this->createQueryBuilder('o')
//            ->select('o.id, o.username, o.email, o.name, o.lastName, o.createdAt')
//            ->andWhere('o.enabled = :active')
//            ->setParameter('active', 1)
//            ->getQuery()
//            ->getResult()
//            ;
    }


    /**
     * {@inheritdoc}
     */
    public function findOneByEmail(string $email): ?UserInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.emailCanonical = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function login(\stdClass $data)
    {
        $username = strtolower($data->username);

        $em = $this->getEntityManager();
        $dql = '
            SELECT UserTianos
            FROM UserBundle:User UserTianos
            WHERE
            (UserTianos.email = :email OR UserTianos.username = :username) AND
            UserTianos.enabled = :active
        ';

        return $em->createQuery($dql)
                ->setParameter('active', 1)
                ->setParameter('email', $username)
                ->setParameter('username', $username)
                ->getOneOrNullResult()
        ;
    }
}
