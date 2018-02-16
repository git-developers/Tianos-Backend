<?php

declare(strict_types=1);

namespace Component\Gato\Model;

use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslationInterface;

interface GatoOptionValueTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void;
}
