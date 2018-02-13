<?php

declare(strict_types=1);

namespace Component\Role\Repository;

use Component\Role\Model\RoleInterface;
use Component\Core\Repository\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface
{

//    /**
//     * @return array
//     */
//    public function gatazo(): array;

    public function find($id);
    public function findAll(): array;
    public function findAllOffsetLimit($offset = 0, $limit = 50): array;
    public function searchBoxRight($q, $offset = 0, $limit = 50): array;


    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|RoleInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|RoleInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
