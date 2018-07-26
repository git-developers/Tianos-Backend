<?php

declare(strict_types=1);

namespace Component\Facultad\Model;

use Component\Resource\Model\TranslatableTrait;
use Component\Resource\Model\TranslationInterface;

class FacultadOptionValue implements FacultadOptionValueInterface
{
    use TranslatableTrait {
        __construct as private initializeTranslationCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var FacultadOptionInterface
     */
    protected $option;

    public function __construct()
    {
        $this->initializeTranslationCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * {@inheritdoc}
     */
    public function getOption(): ?FacultadOptionInterface
    {
        return $this->option;
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(?FacultadOptionInterface $option): void
    {
        $this->option = $option;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue(): ?string
    {
        return $this->getTranslation()->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(?string $value): void
    {
        $this->getTranslation()->setValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \BadMethodCallException
     */
    public function getOptionCode(): ?string
    {
        if (null === $this->option) {
            throw new \BadMethodCallException(
                'The option have not been created yet so you cannot access proxy methods.'
            );
        }

        return $this->option->getCode();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \BadMethodCallException
     */
    public function getName(): ?string
    {
        if (null === $this->option) {
            throw new \BadMethodCallException(
                'The option have not been created yet so you cannot access proxy methods.'
            );
        }

        return $this->option->getName();
    }

    /**
     * @param string|null $locale
     *
     * @return FacultadOptionValueTranslationInterface
     */
    public function getTranslation(?string $locale = null): TranslationInterface
    {
        /** @var FacultadOptionValueTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    /**
     * {@inheritdoc}
     */
    protected function createTranslation(): FacultadOptionValueTranslationInterface
    {
        return new FacultadOptionValueTranslation();
    }
}
