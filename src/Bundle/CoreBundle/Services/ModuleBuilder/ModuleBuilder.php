<?php

namespace CoreBundle\Services\ModuleBuilder;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\ModuleBuilder\ExtendsClass\Route;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Entity\TemplateHasModule;

class ModuleBuilder
{

    const NOT_FOUND_MSG = 'Tianos ModuleBuilder: no se encontro el entity';

    protected $container;
    protected $requestStack;
    protected $entityManager;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $this->requestStack = $container->get('request_stack');
    }

    public function getDeleteTemplate(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insDeleteTemplate();
    }

    public function getFormTemplate(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insFormTemplate();
    }

    public function getViewTemplate(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insViewTemplate();
    }

    public function getFormType(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insFormType();
    }

    public function getClassPath(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insClassPath();
    }

    public function getGroupName(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insGroupName();
    }

    public function defaults(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->getDefaults();
    }

    public function accordion(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->getAccordion();
    }

    public function carousels(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->getCarousels();
    }

    public function crudDefaults(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insCrudDefaults();
    }

    public function crudDataTable(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insCrudDataTable($templateHasModule);
    }

    public function save(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insSave($templateHasModule);
    }

    public function moduleTemplate(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insModuleTemplate();
    }

    public function moduleObject(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insModuleObject($templateHasModule);
    }

    public function moduleTree(TemplateHasModule $templateHasModule)
    {
        $o = ModuleFactory::newInstance($this->container, $templateHasModule);
        return $o->insModuleTree($templateHasModule);
    }

    public function getTemplateHasModuleByRequest()
    {
        $request = $this->requestStack->getCurrentRequest();
        $formData = $request->get('form_data');
        $templateHasModuleId = isset($formData['template_has_module_id']) ? $formData['template_has_module_id'] : null;

        if(is_null($templateHasModuleId)){
            $all = $request->request->all();

            foreach ($all as $key => $all_){
                $all = is_array($all_) ? $all_ : null;
            }
            
            $templateHasModuleId = isset($all['templateHasModule']) ? $all['templateHasModule'] : null;
        }

        return $this->getTemplateHasModule($templateHasModuleId);
    }

    public function getTemplateHasModule($template_has_module_id)
    {
        $templateHasModule = $this->entityManager->getRepository(TemplateHasModule::class)->find($template_has_module_id);

        if ($templateHasModule) {
            return $templateHasModule;
        }

        throw new \Exception(self::NOT_FOUND_MSG);
    }

    public function getTemplateHasModuleByPath($path)
    {

        $route = new Route($path);
        $path = $route->getPath();


//        echo '<pre> POLLO:: ';
//        print_r($path);
//        exit;

        $templateHasModule = $this->entityManager->getRepository(TemplateHasModule::class)->findActiveTemplateByPath($path);






        if ($templateHasModule) {
            return $templateHasModule;
        }

        throw new \Exception(self::NOT_FOUND_MSG);
    }

    public function frontendTemplate(array $templateHasModule = [])
    {

        $code = $templateHasModule['code'];
        $templateName = $templateHasModule['template_name'];

        $template = 'CoreBundle:TemplateFrontend/Template-' . $code . ':Pages/' . $templateName . '.twig';

        if($this->container->get('templating')->exists($template)) {
            return $template;
        }

        return $template = 'CoreBundle:TemplateFrontend/Template-' . $code . ':Pages/default.html.twig';
    }

}
