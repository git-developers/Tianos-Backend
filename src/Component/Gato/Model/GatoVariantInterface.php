<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GatoVariantInterface extends
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
     * @return Collection|GatoOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param GatoOptionValueInterface $optionValue
     */
    public function addOptionValue(GatoOptionValueInterface $optionValue): void;

    /**
     * @param GatoOptionValueInterface $optionValue
     */
    public function removeOptionValue(GatoOptionValueInterface $optionValue): void;

    /**
     * @param GatoOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(GatoOptionValueInterface $optionValue): bool;

    /**
     * @return GatoInterface|null
     */
    public function getGato(): ?GatoInterface;

    /**
     * @param GatoInterface|null $Gato
     */
    public function setGato(?GatoInterface $Gato): void;

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
     * @return GatoVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
