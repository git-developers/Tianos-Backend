<?php

namespace CoreBundle\Services\ModuleBuilder\Module;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use CoreBundle\Services\ModuleBuilder\ExtendsClass\Base;
use CoreBundle\Services\ModuleBuilder\Interfaces\IModule;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEParagraph;

class DefaultModule extends Base implements IModule
{

    public function __construct(Container $container)
    {
        parent::__construct($container);

    }

    public function insModuleTemplate()
    {
        $template = $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:2_default.html.twig';

        if($this->templating->exists($template)) {
            return $template;
        }

        return $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:99_error.html.twig';
    }

    public function insModuleObject(TemplateHasModule $templateHasModule)
    {
        return;
    }

    public function insSave(TemplateHasModule $templateHasModule)
    {
        return;
    }

    public function insCrudDefaults()
    {
        return;
    }

    public function insCrudDataTable()
    {
        return;
    }

}