<?php

namespace CoreBundle\Services\BoxOneToManyGroup;

use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxMiddleMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToManyGroup\Builder\BoxRightMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxOneToManyGroup
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

    public function getBoxMiddleMapper()
    {
        return new BoxMiddleMapper();
    }

    public function getBoxLeftMapper()
    {
        return new BoxLeftMapper();
    }

    public function getBoxRightMapper()
    {
        return new BoxRightMapper();
    }

}