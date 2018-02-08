<?php

namespace CoreBundle\Services\ModuleBuilder\Model;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Services\ModuleBuilder\ExtendsClass\Base;
use CoreBundle\Services\ModuleBuilder\Interfaces\IModule;
use CoreBundle\Entity\TemplateHasModule;

class Template extends Base implements IModule
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->container = $container;
    }

    public function insGetTitle()
    {

        return 'Archivo | Depor.com';
    }

    private function template(TemplateHasModule $templateHasModule)
    {

        $type = $templateHasModule->getModule()->getType();

        echo '<pre> POLLO:: ';
        print_r($type);
        exit;



        /*
        $view = $this->getBundleName() . ':TemplateSetupEdit/Modules:';

        $type = null;

        if(is_object($templateHasModule->getModule())){
            $type = $templateHasModule->getModule()->getType();
        }

        $modules = [
            TemplateModule::PARAGRAPH => $view . '3_paragraph.html.twig',
            TemplateModule::BLOG_POST => $view . '4_blog_post.html.twig',
        ];

        if(isset($modules[$type])){
            return $modules[$type];
        }
        */

        return $view . '2_default.html.twig';
    }

}