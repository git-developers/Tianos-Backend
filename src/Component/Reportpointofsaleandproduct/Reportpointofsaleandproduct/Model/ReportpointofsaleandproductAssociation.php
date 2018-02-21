<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ReportpointofsaleandproductAssociation implements ReportpointofsaleandproductAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ReportpointofsaleandproductAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ReportpointofsaleandproductInterface
     */
    protected $owner;

    /**
     * @var Collection|ReportpointofsaleandproductInterface[]
     */
    protected $associatedReportpointofsaleandproducts;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedReportpointofsaleandproducts = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): ?ReportpointofsaleandproductAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ReportpointofsaleandproductAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ReportpointofsaleandproductInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ReportpointofsaleandproductInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedReportpointofsaleandproducts(): Collection
    {
        return $this->associatedReportpointofsaleandproducts;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): bool
    {
        return $this->associatedReportpointofsaleandproducts->contains($Reportpointofsaleandproduct);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): void
    {
        if (!$this->hasAssociatedReportpointofsaleandproduct($Reportpointofsaleandproduct)) {
            $this->associatedReportpointofsaleandproducts->add($Reportpointofsaleandproduct);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedReportpointofsaleandproduct(ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): void
    {
        if ($this->hasAssociatedReportpointofsaleandproduct($Reportpointofsaleandproduct)) {
            $this->associatedReportpointofsaleandproducts->removeElement($Reportpointofsaleandproduct);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedReportpointofsaleandproducts(): void
    {
        $this->associatedReportpointofsaleandproducts->clear();
    }
}
