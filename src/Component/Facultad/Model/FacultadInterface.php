<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FacultadInterface extends
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
     * @return Collection|FacultadVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param FacultadVariantInterface $variant
     */
    public function addVariant(FacultadVariantInterface $variant): void;

    /**
     * @param FacultadVariantInterface $variant
     */
    public function removeVariant(FacultadVariantInterface $variant): void;

    /**
     * @param FacultadVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(FacultadVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|FacultadOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param FacultadOptionInterface $option
     */
    public function addOption(FacultadOptionInterface $option): void;

    /**
     * @param FacultadOptionInterface $option
     */
    public function removeOption(FacultadOptionInterface $option): void;

    /**
     * @param FacultadOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(FacultadOptionInterface $option): bool;

    /**
     * @return Collection|FacultadAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param FacultadAssociationInterface $association
     */
    public function addAssociation(FacultadAssociationInterface $association): void;

    /**
     * @param FacultadAssociationInterface $association
     */
    public function removeAssociation(FacultadAssociationInterface $association): void;

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
     * @return FacultadTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
