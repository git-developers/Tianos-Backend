<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface FacultadOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return FacultadOptionInterface
     */
    public function getOption(): ?FacultadOptionInterface;

    /**
     * @param FacultadOptionInterface $option
     */
    public function setOption(?FacultadOptionInterface $option): void;

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
     * @return FacultadOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
