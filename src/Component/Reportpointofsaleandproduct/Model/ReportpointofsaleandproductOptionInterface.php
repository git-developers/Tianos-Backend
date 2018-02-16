<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportpointofsaleandproductOptionInterface extends
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
     * @return Collection|ReportpointofsaleandproductOptionValueInterface[]
     */
    public function getValues(): Collection;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     */
    public function addValue(ReportpointofsaleandproductOptionValueInterface $optionValue): void;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     */
    public function removeValue(ReportpointofsaleandproductOptionValueInterface $optionValue): void;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasValue(ReportpointofsaleandproductOptionValueInterface $optionValue): bool;

    /**
     * @param string|null $locale
     *
     * @return ReportpointofsaleandproductOptionTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
