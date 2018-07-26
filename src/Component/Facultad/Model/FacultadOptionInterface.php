<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FacultadOptionInterface extends
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
     * @return Collection|FacultadOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param FacultadOptionValueInterface $optionValue
     */
    public function addValue(FacultadOptionValueInterface $optionValue): void;

    /**
     * @param FacultadOptionValueInterface $optionValue
     */
    public function removeValue(FacultadOptionValueInterface $optionValue): void;

    /**
     * @param FacultadOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(FacultadOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return FacultadOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
