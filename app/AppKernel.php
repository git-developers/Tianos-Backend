<?php

use Bundle\CoreBundle\Application\Kernel;


class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        $bundles = [

            //own bundles
            new \Bundle\UiBundle\UiBundle(),
//            new \Bundle\ClientBundle\ClientBundle(),
            new \Bundle\ApiBundle\ApiBundle(),
//            new \Bundle\UserBundle\UserBundle(),
            new \Bundle\CoreBundle\CoreBundle(),
            new \Bundle\GridBundle\GridBundle(),
            new \Bundle\ThemeBundle\ThemeBundle(),
            new \Bundle\ThemesBundle\ThemesBundle(),
//            new \Bundle\ProductBundle\ProductBundle(),
            new \Bundle\BackendBundle\BackendBundle(),
            new \Bundle\TianosSecurityBundle\TianosSecurityBundle(),
            new \Bundle\FrontendBundle\FrontendBundle(),
            new \Bundle\ResourceBundle\ResourceBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
