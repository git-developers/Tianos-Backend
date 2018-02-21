<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface ReportpointofsaleandproductOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return ReportpointofsaleandproductOptionInterface
     */
    public function getOption(): ?ReportpointofsaleandproductOptionInterface;

    /**
     * @param ReportpointofsaleandproductOptionInterface $option
     */
    public function setOption(?ReportpointofsaleandproductOptionInterface $option): void;

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
     * @return ReportpointofsaleandproductOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
