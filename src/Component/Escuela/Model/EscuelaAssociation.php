<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class EscuelaAssociation implements EscuelaAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var EscuelaAssociationTypeInterface
     */
    protected $type;

    /**
     * @var EscuelaInterface
     */
    protected $owner;

    /**
     * @var Collection|EscuelaInterface[]
     */
    protected $associatedEscuelas;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedEscuelas = new ArrayCollection();
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
    public function getType(): ?EscuelaAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?EscuelaAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?EscuelaInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?EscuelaInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedEscuelas(): Collection
    {
        return $this->associatedEscuelas;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedEscuela(EscuelaInterface $Escuela): bool
    {
        return $this->associatedEscuelas->contains($Escuela);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedEscuela(EscuelaInterface $Escuela): void
    {
        if (!$this->hasAssociatedEscuela($Escuela)) {
            $this->associatedEscuelas->add($Escuela);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedEscuela(EscuelaInterface $Escuela): void
    {
        if ($this->hasAssociatedEscuela($Escuela)) {
            $this->associatedEscuelas->removeElement($Escuela);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedEscuelas(): void
    {
        $this->associatedEscuelas->clear();
    }
}
