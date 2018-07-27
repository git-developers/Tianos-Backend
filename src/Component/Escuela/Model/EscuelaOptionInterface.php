<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface EscuelaOptionInterface extends
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
     * @return Collection|EscuelaOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     */
    public function addValue(EscuelaOptionValueInterface $optionValue): void;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     */
    public function removeValue(EscuelaOptionValueInterface $optionValue): void;

    /**
     * @param EscuelaOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(EscuelaOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return EscuelaOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
