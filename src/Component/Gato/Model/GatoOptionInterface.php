<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GatoOptionInterface extends
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
     * @return Collection|GatoOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param GatoOptionValueInterface $optionValue
     */
    public function addValue(GatoOptionValueInterface $optionValue): void;

    /**
     * @param GatoOptionValueInterface $optionValue
     */
    public function removeValue(GatoOptionValueInterface $optionValue): void;

    /**
     * @param GatoOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(GatoOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return GatoOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
