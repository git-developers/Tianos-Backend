<?php

declare(strict_types=1);

namespace Component\Orderin\Model;

use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslationInterface;

interface OrderinOptionTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;
}
