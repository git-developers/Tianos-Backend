<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\TimestampableTrait;

class ClientAssociation implements ClientAssociationInterface
{
    use TimestampableTrait;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var ClientAssociationTypeInterface
     */
    protected $type;

    /**
     * @var ClientInterface
     */
    protected $owner;

    /**
     * @var Collection|ClientInterface[]
     */
    protected $associatedClients;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->associatedClients = new ArrayCollection();
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
    public function getType(): ?ClientAssociationTypeInterface
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setType(?ClientAssociationTypeInterface $type): void
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner(): ?ClientInterface
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(?ClientInterface $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * {@inheritdoc}
     */
    public function getAssociatedClients(): Collection
    {
        return $this->associatedClients;
    }

    /**
     * {@inheritdoc}
     */
    public function hasAssociatedClient(ClientInterface $Client): bool
    {
        return $this->associatedClients->contains($Client);
    }

    /**
     * {@inheritdoc}
     */
    public function addAssociatedClient(ClientInterface $Client): void
    {
        if (!$this->hasAssociatedClient($Client)) {
            $this->associatedClients->add($Client);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeAssociatedClient(ClientInterface $Client): void
    {
        if ($this->hasAssociatedClient($Client)) {
            $this->associatedClients->removeElement($Client);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clearAssociatedClients(): void
    {
        $this->associatedClients->clear();
    }
}
