<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Doctrine\ORM;

use Bundle\CoreBundle\Doctrine\ORM\EntityRepository as TianosEntityRepository;
use Component\Ticket\Repository\TicketRepositoryInterface;

class TicketHasServiceRepository extends TianosEntityRepository
{

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT ticket
            FROM TicketBundle:Ticket ticket
            WHERE
            ticket.id = :id AND
            ticket.isActive = :active
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('active', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

}
