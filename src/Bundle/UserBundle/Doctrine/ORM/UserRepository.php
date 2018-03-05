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
    public function findAll(): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id, o.username, o.email, o.name, o.lastName, o.createdAt')
            ->andWhere('o.isActive = :active')
            ->setParameter('active', 1)
            ->getQuery()
            ->getResult()
            ;
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
            UserTianos.isActive = :active
        ';

        return $em->createQuery($dql)
                ->setParameter('active', 1)
                ->setParameter('email', $username)
                ->setParameter('username', $username)
                ->getOneOrNullResult()
        ;
    }
}
