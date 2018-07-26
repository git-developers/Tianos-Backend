<?php

declare(strict_types=1);

namespace Component\University\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface UniversityOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return UniversityOptionInterface
     */
    public function getOption(): ?UniversityOptionInterface;

    /**
     * @param UniversityOptionInterface $option
     */
    public function setOption(?UniversityOptionInterface $option): void;

    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void;

    /**
     * @return string|null
     */
    public function getOptionCode(): ?string;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $locale
     *
     * @return UniversityOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
