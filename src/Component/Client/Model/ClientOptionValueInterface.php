<?php

declare(strict_types=1);

namespace Component\Client\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ClientOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ClientOptionInterface
     */
    public function getOption(): ?ClientOptionInterface;

    /**
     * @param ClientOptionInterface $option
     */
    public function setOption(?ClientOptionInterface $option): void;

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
     * @return ClientOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
