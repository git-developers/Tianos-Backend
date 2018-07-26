<?php

declare(strict_types=1);

namespace Component\University\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface UniversityOptionInterface extends
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
     * @return Collection|UniversityOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param UniversityOptionValueInterface $optionValue
     */
    public function addValue(UniversityOptionValueInterface $optionValue): void;

    /**
     * @param UniversityOptionValueInterface $optionValue
     */
    public function removeValue(UniversityOptionValueInterface $optionValue): void;

    /**
     * @param UniversityOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(UniversityOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return UniversityOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
