<?php

//use Symfony\Component\HttpKernel\Kernel;
use Bundle\CoreBundle\Application\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;


class AppKernel extends Kernel
{
    public function registerBundles(): array
    {
        $bundles = [

            //own bundles
            new \Bundle\UiBundle\UiBundle(),
            new \Bundle\ApiBundle\ApiBundle(),
//            new \Bundle\UserBundle\UserBundle(),
            new \Bundle\CoreBundle\CoreBundle(),
            new \Bundle\GridBundle\GridBundle(),
            new \Bundle\ThemeBundle\ThemeBundle(),
            new \Bundle\ThemesBundle\ThemesBundle(),
            new \Bundle\ProductBundle\ProductBundle(),
            new \Bundle\BackendBundle\BackendBundle(),
            new \Bundle\TianosSecurityBundle\TianosSecurityBundle(),
            new \Bundle\FrontendBundle\FrontendBundle(),
            new \Bundle\ResourceBundle\ResourceBundle(),
        ];

        return array_merge(parent::registerBundles(), $bundles);
//        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir(): string
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir(): string
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
