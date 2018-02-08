<?php

namespace CoreBundle\Services\Tree;

use CoreBundle\Services\Tree\Builder\TreeMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Tree
{

    protected $requestStack;
    protected $router;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function getTreeMapper()
    {
        return new TreeMapper($this->router, $this->requestStack);
    }

}