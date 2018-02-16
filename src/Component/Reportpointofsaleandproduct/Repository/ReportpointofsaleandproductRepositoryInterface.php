<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Repository;

use Component\Reportpointofsaleandproduct\Model\ReportpointofsaleandproductInterface;
use Component\Core\Repository\RepositoryInterface;

interface ReportpointofsaleandproductRepositoryInterface extends RepositoryInterface
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
     * @return array|ReportpointofsaleandproductInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ReportpointofsaleandproductInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
