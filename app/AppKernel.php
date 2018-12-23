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
	        new \Bundle\ImageBundle\ImageBundle(),
	        new \Bundle\TicketBundle\TicketBundle(),
	        new \Bundle\ModuleBundle\ModuleBundle(),
	        new \Bundle\GoogleBundle\GoogleBundle(),
	        new \Bundle\ReportBundle\ReportBundle(),
	        new \Bundle\ProfileBundle\ProfileBundle(),
	        new \Bundle\ProductBundle\ProductBundle(),
	        new \Bundle\SessionBundle\SessionBundle(),
	        new \Bundle\CalendarBundle\CalendarBundle(),
	        new \Bundle\ServicesBundle\ServicesBundle(),
	        new \Bundle\CategoryBundle\CategoryBundle(),
            new \Bundle\PointofsaleBundle\PointofsaleBundle(),
            new \Bundle\GroupofusersBundle\GroupofusersBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
