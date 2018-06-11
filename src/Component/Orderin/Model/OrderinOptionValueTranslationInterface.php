<?php

declare(strict_types=1);

namespace Component\Orderin\Model;

use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinOptionValueTranslationInterface extends ResourceInterface, TranslationInterface
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
