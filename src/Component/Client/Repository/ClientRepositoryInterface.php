<?php

declare(strict_types=1);

namespace Component\Client\Repository;

use Component\Client\Model\ClientInterface;
use Component\Core\Repository\RepositoryInterface;

interface ClientRepositoryInterface extends RepositoryInterface
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
     * @return array|ClientInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ClientInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
