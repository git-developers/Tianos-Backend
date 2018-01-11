<?php

declare(strict_types=1);

namespace Bundle\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SecurityBundle extends Bundle
{

}


//
//namespace Bundle\ProductBundle;
//
//use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
//use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
//
//final class ProductBundle extends AbstractResourceBundle
//{
//    /**
//     * {@inheritdoc}
//     */
//    public function getSupportedDrivers(): array
//    {
//        return [
//            SyliusResourceBundle::DRIVER_DOCTRINE_ORM,
//        ];
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    protected function getModelNamespace(): string
//    {
//        return 'Sylius\Component\Product\Model';
//    }
//}
