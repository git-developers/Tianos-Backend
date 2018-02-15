<?php

declare(strict_types=1);

namespace Component\OneToMany\Repository;

use Component\Core\Repository\RepositoryInterface;

interface OneToManyRightRepositoryInterface extends RepositoryInterface
{
    public function searchBoxRight($q, $offset = 0, $limit = 50): array;
    public function find($id);
    public function findAllOffsetLimit($offset = 0, $limit = 50): array;
}
