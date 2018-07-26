<?php

declare(strict_types=1);

namespace Component\University\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface UniversityAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return UniversityAssociationTypeInterface|null
     */
    public function getType(): ?UniversityAssociationTypeInterface;

    /**
     * @param UniversityAssociationTypeInterface|null $type
     */
    public function setType(?UniversityAssociationTypeInterface $type): void;

    /**
     * @return UniversityInterface|null
     */
    public function getOwner(): ?UniversityInterface;

    /**
     * @param UniversityInterface|null $owner
     */
    public function setOwner(?UniversityInterface $owner): void;

    /**
     * @return Collection|UniversityInterface[]
     */
    public function getAssociatedUniversitys(): Collection;

    /**
     * @param UniversityInterface $University
     */
    public function addAssociatedUniversity(UniversityInterface $University): void;

    /**
     * @param UniversityInterface $University
     */
    public function removeAssociatedUniversity(UniversityInterface $University): void;

    /**
     * @param UniversityInterface $University
     *
     * @return bool
     */
    public function hasAssociatedUniversity(UniversityInterface $University): bool;

    public function clearAssociatedUniversitys(): void;
}
