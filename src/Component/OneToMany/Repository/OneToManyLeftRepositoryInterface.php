<?php

declare(strict_types=1);

namespace Component\OneToMany\Repository;

use Component\Core\Repository\RepositoryInterface;

interface OneToManyLeftRepositoryInterface extends RepositoryInterface
{
    public function searchBoxLeft($q, $offset = 0, $limit = 50): array;
    public function find($id);
    public function deleteAllById($id): array;
    public function findAllOffsetLimit($offset = 0, $limit = 50): array;
}
