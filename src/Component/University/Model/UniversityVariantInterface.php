<?php

declare(strict_types=1);

namespace Component\University\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface UniversityVariantInterface extends
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
     * @return Collection|UniversityOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param UniversityOptionValueInterface $optionValue
     */
    public function addOptionValue(UniversityOptionValueInterface $optionValue): void;

    /**
     * @param UniversityOptionValueInterface $optionValue
     */
    public function removeOptionValue(UniversityOptionValueInterface $optionValue): void;

    /**
     * @param UniversityOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(UniversityOptionValueInterface $optionValue): bool;

    /**
     * @return UniversityInterface|null
     */
    public function getUniversity(): ?UniversityInterface;

    /**
     * @param UniversityInterface|null $University
     */
    public function setUniversity(?UniversityInterface $University): void;

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
     * @return UniversityVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
