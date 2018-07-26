<?php

declare(strict_types=1);

namespace Component\Areaacademica\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AreaacademicaVariantInterface extends
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
     * @return Collection|AreaacademicaOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     */
    public function addOptionValue(AreaacademicaOptionValueInterface $optionValue): void;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     */
    public function removeOptionValue(AreaacademicaOptionValueInterface $optionValue): void;

    /**
     * @param AreaacademicaOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(AreaacademicaOptionValueInterface $optionValue): bool;

    /**
     * @return AreaacademicaInterface|null
     */
    public function getAreaacademica(): ?AreaacademicaInterface;

    /**
     * @param AreaacademicaInterface|null $Areaacademica
     */
    public function setAreaacademica(?AreaacademicaInterface $Areaacademica): void;

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
     * @return AreaacademicaVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
