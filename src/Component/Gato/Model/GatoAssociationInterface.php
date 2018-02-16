<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface GatoAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return GatoAssociationTypeInterface|null
     */
    public function getType(): ?GatoAssociationTypeInterface;

    /**
     * @param GatoAssociationTypeInterface|null $type
     */
    public function setType(?GatoAssociationTypeInterface $type): void;

    /**
     * @return GatoInterface|null
     */
    public function getOwner(): ?GatoInterface;

    /**
     * @param GatoInterface|null $owner
     */
    public function setOwner(?GatoInterface $owner): void;

    /**
     * @return Collection|GatoInterface[]
     */
    public function getAssociatedGatos(): Collection;

    /**
     * @param GatoInterface $Gato
     */
    public function addAssociatedGato(GatoInterface $Gato): void;

    /**
     * @param GatoInterface $Gato
     */
    public function removeAssociatedGato(GatoInterface $Gato): void;

    /**
     * @param GatoInterface $Gato
     *
     * @return bool
     */
    public function hasAssociatedGato(GatoInterface $Gato): bool;

    public function clearAssociatedGatos(): void;
}
