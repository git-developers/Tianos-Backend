<?php

declare(strict_types=1);

namespace Component\Areaacademica\Model;

use Component\Resource\Model\CodeAwareInterface;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Model\TranslatableInterface;
use Component\Resource\Model\TranslationInterface;

interface AreaacademicaOptionValueInterface extends ResourceInterface, CodeAwareInterface, TranslatableInterface
{
    /**
     * @return AreaacademicaOptionInterface
     */
    public function getOption(): ?AreaacademicaOptionInterface;

    /**
     * @param AreaacademicaOptionInterface $option
     */
    public function setOption(?AreaacademicaOptionInterface $option): void;

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
     * @return AreaacademicaOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface;
}
