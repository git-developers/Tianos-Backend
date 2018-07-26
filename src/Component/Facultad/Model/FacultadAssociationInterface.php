<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface FacultadAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return FacultadAssociationTypeInterface|null
     */
    public function getType(): ?FacultadAssociationTypeInterface;

    /**
     * @param FacultadAssociationTypeInterface|null $type
     */
    public function setType(?FacultadAssociationTypeInterface $type): void;

    /**
     * @return FacultadInterface|null
     */
    public function getOwner(): ?FacultadInterface;

    /**
     * @param FacultadInterface|null $owner
     */
    public function setOwner(?FacultadInterface $owner): void;

    /**
     * @return Collection|FacultadInterface[]
     */
    public function getAssociatedFacultads(): Collection;

    /**
     * @param FacultadInterface $Facultad
     */
    public function addAssociatedFacultad(FacultadInterface $Facultad): void;

    /**
     * @param FacultadInterface $Facultad
     */
    public function removeAssociatedFacultad(FacultadInterface $Facultad): void;

    /**
     * @param FacultadInterface $Facultad
     *
     * @return bool
     */
    public function hasAssociatedFacultad(FacultadInterface $Facultad): bool;

    public function clearAssociatedFacultads(): void;
}
