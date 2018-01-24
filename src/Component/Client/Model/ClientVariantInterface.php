<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ClientVariantInterface extends
    TimestampableInterface,
    ResourceInterface,
    CodeAwareInterface,
    TranslatableInterface
{
    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string
     */
    public function getDescriptor(): string;

    /**
     * @return Collection|ClientOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ClientOptionValueInterface $optionValue
     */
    public function addOptionValue(ClientOptionValueInterface $optionValue): void;

    /**
     * @param ClientOptionValueInterface $optionValue
     */
    public function removeOptionValue(ClientOptionValueInterface $optionValue): void;

    /**
     * @param ClientOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ClientOptionValueInterface $optionValue): bool;

    /**
     * @return ClientInterface|null
     */
    public function getClient(): ?ClientInterface;

    /**
     * @param ClientInterface|null $Client
     */
    public function setClient(?ClientInterface $Client): void;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @param string|null $locale
     *
     * @return ClientVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
