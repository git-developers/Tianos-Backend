<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FacultadVariantInterface extends
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
     * @return Collection|FacultadOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param FacultadOptionValueInterface $optionValue
     */
    public function addOptionValue(FacultadOptionValueInterface $optionValue): void;

    /**
     * @param FacultadOptionValueInterface $optionValue
     */
    public function removeOptionValue(FacultadOptionValueInterface $optionValue): void;

    /**
     * @param FacultadOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(FacultadOptionValueInterface $optionValue): bool;

    /**
     * @return FacultadInterface|null
     */
    public function getFacultad(): ?FacultadInterface;

    /**
     * @param FacultadInterface|null $Facultad
     */
    public function setFacultad(?FacultadInterface $Facultad): void;

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
     * @return FacultadVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
