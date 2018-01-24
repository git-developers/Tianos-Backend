<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ClientOptionInterface extends
    ResourceInterface,
    CodeAwareInterface,
    TimestampableInterface,
    TranslatableInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return Collection|ClientOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ClientOptionValueInterface $optionValue
     */
    public function addValue(ClientOptionValueInterface $optionValue): void;

    /**
     * @param ClientOptionValueInterface $optionValue
     */
    public function removeValue(ClientOptionValueInterface $optionValue): void;

    /**
     * @param ClientOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ClientOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ClientOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
