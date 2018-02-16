<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface GatoOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return GatoOptionInterface
     */
    public function getOption(): ?GatoOptionInterface;

    /**
     * @param GatoOptionInterface $option
     */
    public function setOption(?GatoOptionInterface $option): void;

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
     * @return GatoOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
