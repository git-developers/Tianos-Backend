<?php

declare(strict_types=1);

namespace Component\Areaacademica\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface AreaacademicaAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return AreaacademicaAssociationTypeInterface|null
     */
    public function getType(): ?AreaacademicaAssociationTypeInterface;

    /**
     * @param AreaacademicaAssociationTypeInterface|null $type
     */
    public function setType(?AreaacademicaAssociationTypeInterface $type): void;

    /**
     * @return AreaacademicaInterface|null
     */
    public function getOwner(): ?AreaacademicaInterface;

    /**
     * @param AreaacademicaInterface|null $owner
     */
    public function setOwner(?AreaacademicaInterface $owner): void;

    /**
     * @return Collection|AreaacademicaInterface[]
     */
    public function getAssociatedAreaacademicas(): Collection;

    /**
     * @param AreaacademicaInterface $Areaacademica
     */
    public function addAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): void;

    /**
     * @param AreaacademicaInterface $Areaacademica
     */
    public function removeAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): void;

    /**
     * @param AreaacademicaInterface $Areaacademica
     *
     * @return bool
     */
    public function hasAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): bool;

    public function clearAssociatedAreaacademicas(): void;
}
