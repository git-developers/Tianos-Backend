<?php

declare(strict_types=1);

namespace Component\Areaacademica\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AreaacademicaOptionInterface extends
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
     * @return Collection|AreaacademicaOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     */
    public function addValue(AreaacademicaOptionValueInterface $optionValue): void;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     */
    public function removeValue(AreaacademicaOptionValueInterface $optionValue): void;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(AreaacademicaOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return AreaacademicaOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
