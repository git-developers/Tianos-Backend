<?php

declare(strict_types=1);

namespace Component\University\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface UniversityInterface extends
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
     * @return Collection|UniversityVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param UniversityVariantInterface $variant
     */
    public function addVariant(UniversityVariantInterface $variant): void;

    /**
     * @param UniversityVariantInterface $variant
     */
    public function removeVariant(UniversityVariantInterface $variant): void;

    /**
     * @param UniversityVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(UniversityVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|UniversityOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param UniversityOptionInterface $option
     */
    public function addOption(UniversityOptionInterface $option): void;

    /**
     * @param UniversityOptionInterface $option
     */
    public function removeOption(UniversityOptionInterface $option): void;

    /**
     * @param UniversityOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(UniversityOptionInterface $option): bool;

    /**
     * @return Collection|UniversityAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param UniversityAssociationInterface $association
     */
    public function addAssociation(UniversityAssociationInterface $association): void;

    /**
     * @param UniversityAssociationInterface $association
     */
    public function removeAssociation(UniversityAssociationInterface $association): void;

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
     * @return UniversityTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
