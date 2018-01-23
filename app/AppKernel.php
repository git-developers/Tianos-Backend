<?php

use Bundle\CoreBundle\Application\Kernel;


class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        $bundles = [

            //own bundles

//            new \Bundle\ClientBundle\ClientBundle(),
//            new \Bundle\UserBundle\UserBundle(),
//            new \Bundle\ProductBundle\ProductBundle(),
            new \Bundle\DUMMY_UPPERBundle\DUMMY_UPPERBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
