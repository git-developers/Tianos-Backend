<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GatoInterface extends
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
     * @return Collection|GatoVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param GatoVariantInterface $variant
     */
    public function addVariant(GatoVariantInterface $variant): void;

    /**
     * @param GatoVariantInterface $variant
     */
    public function removeVariant(GatoVariantInterface $variant): void;

    /**
     * @param GatoVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(GatoVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|GatoOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param GatoOptionInterface $option
     */
    public function addOption(GatoOptionInterface $option): void;

    /**
     * @param GatoOptionInterface $option
     */
    public function removeOption(GatoOptionInterface $option): void;

    /**
     * @param GatoOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(GatoOptionInterface $option): bool;

    /**
     * @return Collection|GatoAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param GatoAssociationInterface $association
     */
    public function addAssociation(GatoAssociationInterface $association): void;

    /**
     * @param GatoAssociationInterface $association
     */
    public function removeAssociation(GatoAssociationInterface $association): void;

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
     * @return GatoTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
