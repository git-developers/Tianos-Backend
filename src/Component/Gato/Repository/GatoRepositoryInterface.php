<?php

declare(strict_types=1);

namespace Component\Gato\Repository;

use Component\Gato\Model\GatoInterface;
use Component\Core\Repository\RepositoryInterface;

interface GatoRepositoryInterface extends RepositoryInterface
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
     * @return array|GatoInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|GatoInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
