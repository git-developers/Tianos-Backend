<?php

namespace CoreBundle\Services\ListHasTree;

use CoreBundle\Services\ListHasTree\Builder\BoxMapper;
use CoreBundle\Services\ListHasTree\Builder\BoxLeftMapper;
use CoreBundle\Services\ListHasTree\Builder\BoxRightMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ListHasTree
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
        return new BoxLeftMapper();
    }

    public function getBoxRightMapper()
    {
        return new BoxRightMapper($this->router, $this->requestStack);
    }

}