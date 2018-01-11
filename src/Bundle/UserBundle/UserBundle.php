<?php

declare(strict_types=1);

namespace Sylius\Bundle\UserBundle;

use Bundle\ResourceBundle\AbstractResourceBundle;
use Bundle\ResourceBundle\ResourceBundle;

final class SyliusUserBundle extends AbstractResourceBundle
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedDrivers(): array
    {
        return [
            ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelNamespace(): string
    {
        return 'Component\User\Model';
    }
}
