<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface EscuelaAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return EscuelaAssociationTypeInterface|null
     */
    public function getType(): ?EscuelaAssociationTypeInterface;

    /**
     * @param EscuelaAssociationTypeInterface|null $type
     */
    public function setType(?EscuelaAssociationTypeInterface $type): void;

    /**
     * @return EscuelaInterface|null
     */
    public function getOwner(): ?EscuelaInterface;

    /**
     * @param EscuelaInterface|null $owner
     */
    public function setOwner(?EscuelaInterface $owner): void;

    /**
     * @return Collection|EscuelaInterface[]
     */
    public function getAssociatedEscuelas(): Collection;

    /**
     * @param EscuelaInterface $Escuela
     */
    public function addAssociatedEscuela(EscuelaInterface $Escuela): void;

    /**
     * @param EscuelaInterface $Escuela
     */
    public function removeAssociatedEscuela(EscuelaInterface $Escuela): void;

    /**
     * @param EscuelaInterface $Escuela
     *
     * @return bool
     */
    public function hasAssociatedEscuela(EscuelaInterface $Escuela): bool;

    public function clearAssociatedEscuelas(): void;
}
