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
            new \Bundle\GoogleBundle\GoogleBundle(),
            new \Bundle\ReportBundle\ReportBundle(),
            new \Bundle\ProfileBundle\ProfileBundle(),
            new \Bundle\SessionBundle\SessionBundle(),
            new \Bundle\EscuelaBundle\EscuelaBundle(),
            new \Bundle\FacultadBundle\FacultadBundle(),
            new \Bundle\CategoryBundle\CategoryBundle(),
            new \Bundle\UniversityBundle\UniversityBundle(),
            new \Bundle\PointofsaleBundle\PointofsaleBundle(),
            new \Bundle\GroupofusersBundle\GroupofusersBundle(),
            new \Bundle\AreaacademicaBundle\AreaacademicaBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
    }
}
