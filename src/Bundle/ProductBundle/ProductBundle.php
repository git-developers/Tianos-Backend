<?php

declare(strict_types=1);

namespace Bundle\ProductBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProductBundle extends Bundle
{

}


//
//namespace Bundle\ProductBundle;
//
//use Sylius\Bundle\ResourceBundle\AbstractResourceBundle;
//use Sylius\Bundle\ResourceBundle\ResourceBundle;
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
