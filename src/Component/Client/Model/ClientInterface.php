<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Doctrine\Common\Collections\Collection;
use Component\Attribute\Model\AttributeSubjectInterface;
use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\SlugAwareInterface;
use Component\Resource\Model\TimestampableInterface;
use Component\Resource\Model\ToggleableInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ClientInterface extends
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
     * @return Collection|ClientVariantInterface[]
     */
    public function getVariants(): Collection;

    /**
     * @param ClientVariantInterface $variant
     */
    public function addVariant(ClientVariantInterface $variant): void;

    /**
     * @param ClientVariantInterface $variant
     */
    public function removeVariant(ClientVariantInterface $variant): void;

    /**
     * @param ClientVariantInterface $variant
     *
     * @return bool
     */
    public function hasVariant(ClientVariantInterface $variant): bool;

    /**
     * @return bool
     */
    public function hasOptions(): bool;

    /**
     * @return Collection|ClientOptionInterface[]
     */
    public function getOptions(): Collection;

    /**
     * @param ClientOptionInterface $option
     */
    public function addOption(ClientOptionInterface $option): void;

    /**
     * @param ClientOptionInterface $option
     */
    public function removeOption(ClientOptionInterface $option): void;

    /**
     * @param ClientOptionInterface $option
     *
     * @return bool
     */
    public function hasOption(ClientOptionInterface $option): bool;

    /**
     * @return Collection|ClientAssociationInterface[]
     */
    public function getAssociations(): Collection;

    /**
     * @param ClientAssociationInterface $association
     */
    public function addAssociation(ClientAssociationInterface $association): void;

    /**
     * @param ClientAssociationInterface $association
     */
    public function removeAssociation(ClientAssociationInterface $association): void;

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
     * @return ClientTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
