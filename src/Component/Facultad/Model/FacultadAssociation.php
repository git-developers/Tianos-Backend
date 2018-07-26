<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class FacultadAssociation implements FacultadAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var FacultadAssociationTypeInterface
     */
    protected $type;

    /**
     * @var FacultadInterface
     */
    protected $owner;

    /**
     * @var Collection|FacultadInterface[]
     */
    protected $associatedFacultads;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedFacultads = new ArrayCollection();
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
    public function getType(): ?FacultadAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?FacultadAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?FacultadInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?FacultadInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedFacultads(): Collection
    {
        return $this->associatedFacultads;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedFacultad(FacultadInterface $Facultad): bool
    {
        return $this->associatedFacultads->contains($Facultad);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedFacultad(FacultadInterface $Facultad): void
    {
        if (!$this->hasAssociatedFacultad($Facultad)) {
            $this->associatedFacultads->add($Facultad);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedFacultad(FacultadInterface $Facultad): void
    {
        if ($this->hasAssociatedFacultad($Facultad)) {
            $this->associatedFacultads->removeElement($Facultad);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedFacultads(): void
    {
        $this->associatedFacultads->clear();
    }
}
