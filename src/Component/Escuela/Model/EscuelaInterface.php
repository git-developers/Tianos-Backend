<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface EscuelaInterface extends
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
     * @return Collection|EscuelaVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param EscuelaVariantInterface $variant
     */
    public function addVariant(EscuelaVariantInterface $variant): void;

    /**
     * @param EscuelaVariantInterface $variant
     */
    public function removeVariant(EscuelaVariantInterface $variant): void;

    /**
     * @param EscuelaVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(EscuelaVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|EscuelaOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param EscuelaOptionInterface $option
     */
    public function addOption(EscuelaOptionInterface $option): void;

    /**
     * @param EscuelaOptionInterface $option
     */
    public function removeOption(EscuelaOptionInterface $option): void;

    /**
     * @param EscuelaOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(EscuelaOptionInterface $option): bool;

    /**
     * @return Collection|EscuelaAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param EscuelaAssociationInterface $association
     */
    public function addAssociation(EscuelaAssociationInterface $association): void;

    /**
     * @param EscuelaAssociationInterface $association
     */
    public function removeAssociation(EscuelaAssociationInterface $association): void;

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
     * @return EscuelaTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
