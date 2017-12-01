<?php

namespace CoreBundle\Services\ModuleBuilder\ExtendsClass;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\Container;
use JMS\Serializer\SerializationContext;
use CoreBundle\Entity\TemplateHasModule;

class Base
{

    const BODY_CSS = 'module-body';

    const MODULE_MAIN_DIV = 'box-main-div';
    const MODULE_SPAN = 'module-span';
    const MODULE_MAIN_UL = 'module-main-ul';

    const ASSIGN_GROUP_NAME_KEY_1 = 'template';
    const ASSIGN_GROUP_NAME_KEY_2 = 'module';

    protected $container;
    protected $templating;
    protected $requestStack;
    protected $entityManager;
    protected $jmsSerializer;

    protected $defaults;
    protected $accordion;
    protected $carousels;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->templating = $container->get('templating');
        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $this->requestStack = $container->get('request_stack');
        $this->jmsSerializer = $container->get('jms_serializer');

        $this->defaults = [
            'body_css' => self::BODY_CSS,

            'module_main_div' => self::MODULE_MAIN_DIV,
            'module_main_ul' => self::MODULE_MAIN_UL,
            'module_span' => self::MODULE_SPAN,

            'assign_group_name_key_1' => self::ASSIGN_GROUP_NAME_KEY_1,
            'assign_group_name_key_2' => self::ASSIGN_GROUP_NAME_KEY_2,
        ];
    }

    public function getBundleName()
    {
        $request = $this->requestStack->getCurrentRequest();
        $controller = $request->attributes->get('_controller');
        list($bundle) = explode('\\', $controller);
        return $bundle;
    }

    public function getControllerName()
    {
        $request = $this->requestStack->getCurrentRequest();
        $controller = $request->attributes->get('_controller');

        $pattern = "/Controller\\\\([a-zA-Z]*)Controller/";
        $matches = [];
        preg_match($pattern, $controller, $matches);
        return end($matches);
    }

    public function insModuleTree(TemplateHasModule $templateHasModule)
    {
        $templateId = $templateHasModule->getTemplate()->getIdIncrement();
        $leftHasRight = $this->entityManager->getRepository(TemplateHasModule::class)->findBoxleftHasBoxrightParent($templateId);
        return $this->getTreeEntities($leftHasRight);
    }

    protected function getTreeEntities($parents)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $entity = [];
        foreach ($parents as $key => $parent){

            $entity[$key]['parent'] = $this->getSerializeDecode($parent, 'template_has_module');

            $children = $this->entityManager->getRepository(TemplateHasModule::class)->findAllByParent($parent);
            $entity[$key]['children'] = $this->getTreeEntities($children);
        }

        return $entity;
    }

    protected function getSerialize($object, $groupName)
    {
        return $this->jmsSerializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
    }

    protected function getSerializeDecode($object, $groupName)
    {
        $objects = $this->getSerialize($object, $groupName);
        return json_decode($objects, true);
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

    public function getAccordion()
    {
//        return $this->accordion;

        return [
            [
                'name' => 'Modules',
            ],
            [
                'name' => 'Mockup',
            ],
        ];
    }

    public function getCarousels()
    {
//        return $this->carousels;

        return [
            [
                'name' => 'Informacion 1',
            ],
            [
                'name' => 'Informacion 2',
            ],
            [
                'name' => 'Informacion 3',
            ],
            [
                'name' => 'Informacion 4',
            ],
        ];
    }

}