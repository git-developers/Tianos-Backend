<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportpointofsaleandproductInterface extends
    AttributeSubjectInterface,
    CodeAwareInterface,
    ResourceInterface,
    SlugAwareInterface,
    TimestampableInterface,
    ToggleableInterface,
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
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return string|null
     */
    public function getMetaKeywords(): ?string;

    /**
     * @param string|null $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void;

    /**
     * @return string|null
     */
    public function getMetaDescription(): ?string;

    /**
     * @param string|null $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void;

    /**
     * @return bool
     */
    public function hasVariants(): bool;

    /**
     * @return Collection|ReportpointofsaleandproductVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ReportpointofsaleandproductVariantInterface $variant
     */
    public function addVariant(ReportpointofsaleandproductVariantInterface $variant): void;

    /**
     * @param ReportpointofsaleandproductVariantInterface $variant
     */
    public function removeVariant(ReportpointofsaleandproductVariantInterface $variant): void;

    /**
     * @param ReportpointofsaleandproductVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ReportpointofsaleandproductVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ReportpointofsaleandproductOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ReportpointofsaleandproductOptionInterface $option
     */
    public function addOption(ReportpointofsaleandproductOptionInterface $option): void;

    /**
     * @param ReportpointofsaleandproductOptionInterface $option
     */
    public function removeOption(ReportpointofsaleandproductOptionInterface $option): void;

    /**
     * @param ReportpointofsaleandproductOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ReportpointofsaleandproductOptionInterface $option): bool;

    /**
     * @return Collection|ReportpointofsaleandproductAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ReportpointofsaleandproductAssociationInterface $association
     */
    public function addAssociation(ReportpointofsaleandproductAssociationInterface $association): void;

    /**
     * @param ReportpointofsaleandproductAssociationInterface $association
     */
    public function removeAssociation(ReportpointofsaleandproductAssociationInterface $association): void;

    /**
     * @return bool
     */
    public function isSimple(): bool;

    /**
     * @return bool
     */
    public function isConfigurable(): bool;

    /**
     * @param string|null $locale
     *
     * @return ReportpointofsaleandproductTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
