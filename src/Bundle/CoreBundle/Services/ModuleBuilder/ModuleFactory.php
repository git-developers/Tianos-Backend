<?php

namespace CoreBundle\Services\ModuleBuilder;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Services\ModuleBuilder\Module\DefaultModule;

class ModuleFactory {

    protected static $instance = null;

    public function __construct() {

    }

    public static function newInstance (Container $container, TemplateHasModule $templateHasModule) {

        if (!isset(static::$instance)) {

            $type = self::getTypeString($templateHasModule);
            $element = "CoreBundle\\Services\\ModuleBuilder\\Module\\".$type;

            if (class_exists($element)) {
                static::$instance = new $element($container);
            }else{
                static::$instance = new DefaultModule($container);
            }
        }

        return static::$instance;
    }

    private static function getTypeString(TemplateHasModule $templateHasModule) {

        $type = is_object($templateHasModule->getModule()) ? $templateHasModule->getModule()->getType() : null;
        $types = explode('_', $type);

        $typeString = '';
        foreach ($types as $key => $type){
            $typeString .= ucwords(strtolower($type));
        }

        return $typeString;
    }

}