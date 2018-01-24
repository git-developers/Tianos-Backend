<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;

interface ClientAssociationInterface extends TimestampableInterface, ResourceInterface
{
    /**
     * @return ClientAssociationTypeInterface|null
     */
    public function getType(): ?ClientAssociationTypeInterface;

    /**
     * @param ClientAssociationTypeInterface|null $type
     */
    public function setType(?ClientAssociationTypeInterface $type): void;

    /**
     * @return ClientInterface|null
     */
    public function getOwner(): ?ClientInterface;

    /**
     * @param ClientInterface|null $owner
     */
    public function setOwner(?ClientInterface $owner): void;

    /**
     * @return Collection|ClientInterface[]
     */
    public function getAssociatedClients(): Collection;

    /**
     * @param ClientInterface $Client
     */
    public function addAssociatedClient(ClientInterface $Client): void;

    /**
     * @param ClientInterface $Client
     */
    public function removeAssociatedClient(ClientInterface $Client): void;

    /**
     * @param ClientInterface $Client
     *
     * @return bool
     */
    public function hasAssociatedClient(ClientInterface $Client): bool;

    public function clearAssociatedClients(): void;
}
