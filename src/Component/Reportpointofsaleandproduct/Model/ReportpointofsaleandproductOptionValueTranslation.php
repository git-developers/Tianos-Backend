<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Component\Resource\Model\AbstractTranslation;

class ReportpointofsaleandproductOptionValueTranslation extends AbstractTranslation implements ReportpointofsaleandproductOptionValueTranslationInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;

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
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
