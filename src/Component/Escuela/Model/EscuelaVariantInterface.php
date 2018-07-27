<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface EscuelaVariantInterface extends
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
     * @return Collection|EscuelaOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     */
    public function addOptionValue(EscuelaOptionValueInterface $optionValue): void;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     */
    public function removeOptionValue(EscuelaOptionValueInterface $optionValue): void;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(EscuelaOptionValueInterface $optionValue): bool;

    /**
     * @return EscuelaInterface|null
     */
    public function getEscuela(): ?EscuelaInterface;

    /**
     * @param EscuelaInterface|null $Escuela
     */
    public function setEscuela(?EscuelaInterface $Escuela): void;

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
     * @return EscuelaVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
