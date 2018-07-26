<?php

declare(strict_types=1);

namespace Component\Areaacademica\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class AreaacademicaAssociation implements AreaacademicaAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var AreaacademicaAssociationTypeInterface
     */
    protected $type;

    /**
     * @var AreaacademicaInterface
     */
    protected $owner;

    /**
     * @var Collection|AreaacademicaInterface[]
     */
    protected $associatedAreaacademicas;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedAreaacademicas = new ArrayCollection();
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
    public function getType(): ?AreaacademicaAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?AreaacademicaAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?AreaacademicaInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?AreaacademicaInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedAreaacademicas(): Collection
    {
        return $this->associatedAreaacademicas;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): bool
    {
        return $this->associatedAreaacademicas->contains($Areaacademica);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): void
    {
        if (!$this->hasAssociatedAreaacademica($Areaacademica)) {
            $this->associatedAreaacademicas->add($Areaacademica);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedAreaacademica(AreaacademicaInterface $Areaacademica): void
    {
        if ($this->hasAssociatedAreaacademica($Areaacademica)) {
            $this->associatedAreaacademicas->removeElement($Areaacademica);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedAreaacademicas(): void
    {
        $this->associatedAreaacademicas->clear();
    }
}
