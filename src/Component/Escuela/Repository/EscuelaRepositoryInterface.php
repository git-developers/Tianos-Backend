<?php

declare(strict_types=1);

namespace Component\Escuela\Repository;

use Component\Escuela\Model\EscuelaInterface;
use Component\Core\Repository\RepositoryInterface;

interface EscuelaRepositoryInterface extends RepositoryInterface
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
     * @return array|EscuelaInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|EscuelaInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
