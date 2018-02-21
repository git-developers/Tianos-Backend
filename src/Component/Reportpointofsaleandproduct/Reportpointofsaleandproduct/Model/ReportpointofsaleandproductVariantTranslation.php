<?php

declare(strict_types=1);

namespace Component\Reportpointofsaleandproduct\Model;

use Component\Resource\Model\AbstractTranslation;

class ReportpointofsaleandproductVariantTranslation extends AbstractTranslation implements ReportpointofsaleandproductVariantTranslationInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
