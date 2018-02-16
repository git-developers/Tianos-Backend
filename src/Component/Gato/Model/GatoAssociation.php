<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class GatoAssociation implements GatoAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var GatoAssociationTypeInterface
     */
    protected $type;

    /**
     * @var GatoInterface
     */
    protected $owner;

    /**
     * @var Collection|GatoInterface[]
     */
    protected $associatedGatos;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedGatos = new ArrayCollection();
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
    public function getType(): ?GatoAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?GatoAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?GatoInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?GatoInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedGatos(): Collection
    {
        return $this->associatedGatos;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedGato(GatoInterface $Gato): bool
    {
        return $this->associatedGatos->contains($Gato);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedGato(GatoInterface $Gato): void
    {
        if (!$this->hasAssociatedGato($Gato)) {
            $this->associatedGatos->add($Gato);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedGato(GatoInterface $Gato): void
    {
        if ($this->hasAssociatedGato($Gato)) {
            $this->associatedGatos->removeElement($Gato);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedGatos(): void
    {
        $this->associatedGatos->clear();
    }
}
