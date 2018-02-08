<?php

namespace CoreBundle\Services\Common;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Base
{

    protected $router;
    protected $requestStack;
    protected $defaults;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    /**
     * @return mixed
     */
    public function getDefaults()
    {
        return $this->defaults;
    }

    /**
     * @param mixed $defaults
     */
    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
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

    public function getControllerNameLower()
    {
        return strtolower($this->getControllerName());
    }

    public function getControllerNameUpper()
    {
        return strtoupper($this->getControllerName());
    }

    public function role($action = null)
    {
        return 'ROLE_' . $this->getControllerNameUpper() . '_' . strtoupper($action);
    }

    public function switchRoute($action = null)
    {
        $bundle = $this->getBundleNameOnly();
        $controller = $this->getControllerNameLower();
        $route = $bundle . '_' . $controller . '_' . $action;

        $routeInsert = isset($this->defaults['route_' . $action]) ? $this->defaults['route_' . $action] : null;
        if($routeInsert){
            return $this->router->generate($routeInsert);
        }

        return $this->router->generate($route);
    }

    public function getBundleName()
    {
        $request = $this->requestStack->getCurrentRequest();
        $controller = $request->attributes->get('_controller');
        list($bundle) = explode('\\', $controller);
        return $bundle;
    }

    public function getBundleNameOnly()
    {
        $bundleName = strtolower($this->getBundleName());
        return str_replace('bundle', '', $bundleName);
    }

    protected function handleSearchValueBase(Request $request, $boxSearch)
    {
        $fields = $request->get('fields');
        $fields = is_array($fields) ? $fields : [];

        foreach ($fields as $key => $value){
            if($value['name'] == $boxSearch){
                return trim($value['value']);
            }
        }

        return null;
    }

    protected function handleSelectedIdSingle(Request $request, $boxValue)
    {
        $fields = $request->get('fields');
        $fields = is_array($fields) ? $fields : [];

        foreach ($fields as $key => $value){
            $id = trim($value['value']);
            if($value['name'] == $boxValue && is_numeric($id)){
                return $id;
            }
        }

        return null;
    }

    protected function handleSelectedIdArray(Request $request, $boxValueHidden)
    {
        $out = [];
        $fields = $request->get('fields');
        $fields = is_array($fields) ? $fields : [];

        foreach ($fields as $key => $value){
            $id = trim($value['value']);
            if($value['name'] == $boxValueHidden){ //  && !empty($id)
                $out[] = $id;
            }
        }

        return $out;
    }

    /**
     * ########### Template ###########
     */
    public function getFormTemplate($folder = 'Form', $html = 'form')
    {
        if(!is_null($this->defaults['template_create'])){
            return $this->defaults['template_create'];
        }

        if(!is_null($this->defaults['template_edit'])){
            return $this->defaults['template_edit'];
        }

        $bundle = $this->getBundleName();
        $controllerName = $this->getControllerName();
        return $bundle . ':' . $controllerName . ':' . $folder . '/' . $html . '.html.twig';
    }

    public function getInfoTemplate($folder = 'Informative', $html = 'info')
    {
        $bundle = $this->getBundleName();
        $controllerName = $this->getControllerName();
        return $bundle . ':' . $controllerName . ':' . $folder . '/' . $html . '.html.twig';
    }

    public function getViewTemplate($folder = 'Informative', $html = 'view')
    {
        if(!is_null($this->defaults['template_view'])){
            return $this->defaults['template_view'];
        }

        $bundle = $this->getBundleName();
        $controllerName = $this->getControllerName();
        return $bundle . ':' . $controllerName . ':' . $folder . '/' . $html . '.html.twig';
    }

    public function getAssociativeTemplate($folder = 'Associative', $html = 'form')
    {
        $bundle = $this->getBundleName();
        $controllerName = $this->getControllerName();
        return $bundle . ':' . $controllerName . ':' . $folder . '/' . $html . '.html.twig';
    }

    public function getDeleteTemplate($bundle = 'CoreBundle', $controllerName = 'Crud', $folder = 'Template', $html = 'delete')
    {
        if(!is_null($this->defaults['template_delete'])){
            return $this->defaults['template_delete'];
        }

//        'CoreBundle:Crud:Template/delete.html.twig'

//        $bundle = $this->getBundleName();
//        $controllerName = $this->getControllerName();
        return $bundle . ':' . $controllerName . ':' . $folder . '/' . $html . '.html.twig';
//        return 'CoreBundle:Crud:' . $folder . '/' . $html . '.html.twig';
    }
    /**
     * ########### Template ###########
     */


    protected function isValidKey($key, $defaults)
    {
        if (!array_key_exists($key, $defaults)) {
            throw new \Error(get_called_class() . ': el key "'.$key.'" que ingreso no existe en el mapper');
        }
        return;
    }

}