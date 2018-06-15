<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Doctrine\ORM;

use Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Component\User\Model\UserInterface;
use Component\User\Repository\UserRepositoryInterface;
use Component\OneToMany\Repository\OneToManyLeftRepositoryInterface;
use Bundle\ProfileBundle\Entity\Profile;

class UserRepository extends EntityRepository
    implements UserRepositoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimitDistribuidor($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active AND
            profile.nameCanonical = :nameCanonical
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('nameCanonical', Profile::DISTRIBUIDOR);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimitTransportista($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active AND
            profile.nameCanonical = :nameCanonical
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('nameCanonical', Profile::TRANSPORTISTA);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findAllOffsetLimitCanillita($offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            user_.enabled = :active AND
            profile.nameCanonical = :nameCanonical
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('nameCanonical', Profile::CANILLITA);
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
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.enabled = :active
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
            ->where('a.enabled = :active')
            ->orderBy('a.id', 'ASC')
            ->setParameter('active', true)
            ;
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

    /**
     * {@inheritdoc}
     */
    public function oneToManyLeft($leftValue)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            user_.id = :id AND
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $leftValue);

        return $query->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxRightCanillita($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            user_.enabled = :active AND
            profile.nameCanonical = :nameCanonical
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('q', '%' . $q . '%');
        $query->setParameter('nameCanonical', Profile::CANILLITA);
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxRight($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            user_.enabled = :active
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
    public function searchBoxLeftDistribuidor($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            profile.nameCanonical = :nameCanonical AND
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('nameCanonical', Profile::DISTRIBUIDOR);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeftTransportista($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_, profile
            FROM UserBundle:User user_
            INNER JOIN user_.profile profile
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            profile.nameCanonical = :nameCanonical AND
            user_.enabled = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('nameCanonical', Profile::TRANSPORTISTA);
        $query->setParameter('q', '%' . $q . '%');
        $query->setFirstResult($offset);
        $query->setMaxResults($limit);

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user_
            FROM UserBundle:User user_
            WHERE
            ( user_.name LIKE :q OR user_.lastName LIKE :q ) AND
            user_.enabled = :active
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
    public function deleteAssociativeTableById($id): bool
    {
//        return $em->getConnection()
//            ->prepare('DELETE FROM profile_has_role WHERE profile_id = :id;')
//            ->bindValue('id', $id)
//            ->execute()
//            ;

        $em = $this->getEntityManager();
        $sql = "DELETE FROM user_has_route WHERE user_id = :id;";
        $params = array('id' => $id);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute($params);

        // puesto provisional
        return true;
    }
}
