<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportpointofsaleandproductVariantTranslationInterface extends ResourceInterface, TranslationInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;
}
