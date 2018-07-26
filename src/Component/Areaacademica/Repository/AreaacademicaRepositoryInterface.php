<?php

declare(strict_types=1);

namespace Component\Areaacademica\Repository;

use Component\Areaacademica\Model\AreaacademicaInterface;
use Component\Core\Repository\RepositoryInterface;

interface AreaacademicaRepositoryInterface extends RepositoryInterface
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
     * @return array|AreaacademicaInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|AreaacademicaInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
