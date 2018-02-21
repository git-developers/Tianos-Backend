<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportpointofsaleandproductVariantInterface extends
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
     * @return Collection|ReportpointofsaleandproductOptionValueInterface[]
     */
    public function getOptionValues(): Collection;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     */
    public function addOptionValue(ReportpointofsaleandproductOptionValueInterface $optionValue): void;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     */
    public function removeOptionValue(ReportpointofsaleandproductOptionValueInterface $optionValue): void;

    /**
     * @param ReportpointofsaleandproductOptionValueInterface $optionValue
     *
     * @return bool
     */
    public function hasOptionValue(ReportpointofsaleandproductOptionValueInterface $optionValue): bool;

    /**
     * @return ReportpointofsaleandproductInterface|null
     */
    public function getReportpointofsaleandproduct(): ?ReportpointofsaleandproductInterface;

    /**
     * @param ReportpointofsaleandproductInterface|null $Reportpointofsaleandproduct
     */
    public function setReportpointofsaleandproduct(?ReportpointofsaleandproductInterface $Reportpointofsaleandproduct): void;

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
     * @return ReportpointofsaleandproductVariantTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
