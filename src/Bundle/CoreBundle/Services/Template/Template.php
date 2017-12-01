<?php

namespace CoreBundle\Services\Template;

use CoreBundle\Services\Template\Builder\TemplateMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Template
{

    protected $requestStack;
    protected $router;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function getTemplateMapper()
    {
        return new TemplateMapper($this->router, $this->requestStack);
    }

}