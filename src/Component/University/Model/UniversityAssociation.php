<?php

declare(strict_types=1);

namespace Component\University\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class UniversityAssociation implements UniversityAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var UniversityAssociationTypeInterface
     */
    protected $type;

    /**
     * @var UniversityInterface
     */
    protected $owner;

    /**
     * @var Collection|UniversityInterface[]
     */
    protected $associatedUniversitys;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedUniversitys = new ArrayCollection();
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
    public function getType(): ?UniversityAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?UniversityAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?UniversityInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?UniversityInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedUniversitys(): Collection
    {
        return $this->associatedUniversitys;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedUniversity(UniversityInterface $University): bool
    {
        return $this->associatedUniversitys->contains($University);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedUniversity(UniversityInterface $University): void
    {
        if (!$this->hasAssociatedUniversity($University)) {
            $this->associatedUniversitys->add($University);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedUniversity(UniversityInterface $University): void
    {
        if ($this->hasAssociatedUniversity($University)) {
            $this->associatedUniversitys->removeElement($University);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedUniversitys(): void
    {
        $this->associatedUniversitys->clear();
    }
}
