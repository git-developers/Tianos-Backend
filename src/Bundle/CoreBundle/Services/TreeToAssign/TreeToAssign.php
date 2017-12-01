<?php

namespace CoreBundle\Services\TreeToAssign;

use CoreBundle\Services\TreeToAssign\Builder\BoxMapper;
use CoreBundle\Services\TreeToAssign\Builder\BoxLeftMapper;
use CoreBundle\Services\TreeToAssign\Builder\BoxRightMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;


class TreeToAssign
{

    protected $requestStack;
    protected $router;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function getBoxMapper()
    {
        return new BoxMapper($this->router, $this->requestStack);
    }

    public function getBoxLeftMapper()
    {
        return new BoxLeftMapper($this->router, $this->requestStack);
    }

    public function getBoxRightMapper()
    {
        return new BoxRightMapper($this->router, $this->requestStack);
    }

}