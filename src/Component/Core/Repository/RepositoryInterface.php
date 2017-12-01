<?php

//declare(strict_types=1);

namespace Component\Core\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Component\Core\Model\ResourceInterface;

interface RepositoryInterface extends ObjectRepository
{
    public const ORDER_ASCENDING = 'ASC';
    public const ORDER_DESCENDING = 'DESC';

    /**
     * @param array $criteria
     * @param array $sorting
     *
     * @return iterable
     */
    public function createPaginator(array $criteria = [], array $sorting = []): iterable;

    /**
     * @param ResourceInterface $resource
     */
    public function add(ResourceInterface $resource): void;

    /**
     * @param ResourceInterface $resource
     */
    public function remove(ResourceInterface $resource): void;
}
