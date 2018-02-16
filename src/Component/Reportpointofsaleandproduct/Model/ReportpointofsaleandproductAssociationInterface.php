<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ReportpointofsaleandproductAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ReportpointofsaleandproductAssociationTypeInterface|null
     */
    public function getType(): ?ReportpointofsaleandproductAssociationTypeInterface;

    /**
     * @param ReportpointofsaleandproductAssociationTypeInterface|null $type
     */
    public function setType(?ReportpointofsaleandproductAssociationTypeInterface $type): void;

    /**
     * @return ReportpointofsaleandproductInterface|null
     */
    public function getOwner(): ?ReportpointofsaleandproductInterface;

    /**
     * @param ReportpointofsaleandproductInterface|null $owner
     */
    public function setOwner(?ReportpointofsaleandproductInterface $owner): void;

    /**
     * @return Collection|ReportpointofsaleandproductInterface[]
     */
    public function getAssociatedReportpointofsaleandproducts(): Collection;

    /**
     * @param ReportpointofsaleandproductInterface $Reportpointofsaleandproduct
     */
    public function addAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): void;

    /**
     * @param ReportpointofsaleandproductInterface $Reportpointofsaleandproduct
     */
    public function removeAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): void;

    /**
     * @param ReportpointofsaleandproductInterface $Reportpointofsaleandproduct
     *
     * @return bool
     */
    public function hasAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): bool;

    public function clearAssociatedReportpointofsaleandproducts(): void;
}
