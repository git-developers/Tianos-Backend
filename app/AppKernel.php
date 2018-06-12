<?php

use Bundle\CoreBundle\Application\Kernel;


class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        $bundles = [

            //own bundles
            new \Bundle\RoleBundle\RoleBundle(),
            new \Bundle\VisitBundle\VisitBundle(),
            new \Bundle\RouteBundle\RouteBundle(),
            new \Bundle\ClientBundle\ClientBundle(),
            new \Bundle\ProfileBundle\ProfileBundle(),
            new \Bundle\ProductBundle\ProductBundle(),
            new \Bundle\SessionBundle\SessionBundle(),
            new \Bundle\CategoryBundle\CategoryBundle(),
            new \Bundle\PointofsaleBundle\PointofsaleBundle(),
            new \Bundle\GroupofusersBundle\GroupofusersBundle(),
            new \Bundle\PdvhasproductBundle\PdvhasproductBundle(),
            new \Bundle\OrderBundle\OrderBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
