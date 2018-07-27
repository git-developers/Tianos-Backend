<?php

declare(strict_types=1);

namespace Component\Escuela\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface EscuelaOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return EscuelaOptionInterface
     */
    public function getOption(): ?EscuelaOptionInterface;

    /**
     * @param EscuelaOptionInterface $option
     */
    public function setOption(?EscuelaOptionInterface $option): void;

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
     * @return EscuelaOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
