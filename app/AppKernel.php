<?php

use Bundle\CoreBundle\Application\Kernel;


class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        $bundles = [

            //own bundles
            new \Bundle\SessionBundle\SessionBundle(),
            new \Bundle\RoleBundle\RoleBundle(),
            new \Bundle\ClientBundle\ClientBundle(),
            new \Bundle\ProfileBundle\ProfileBundle(),
            new \Bundle\ProductBundle\ProductBundle(),
            new \Bundle\CategoryBundle\CategoryBundle(),
            new \Bundle\PointofsaleBundle\PointofsaleBundle(),
            new \Bundle\GroupofusersBundle\GroupofusersBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
