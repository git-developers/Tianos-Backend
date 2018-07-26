<?php

declare(strict_types=1);

namespace Component\University\Repository;

use Component\University\Model\UniversityInterface;
use Component\Core\Repository\RepositoryInterface;

interface UniversityRepositoryInterface extends RepositoryInterface
{

//    /**
//     * @return array
//     */
//    public function gatazo(): array;

    public function find($id);
    public function findAll(): array;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|UniversityInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|UniversityInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
