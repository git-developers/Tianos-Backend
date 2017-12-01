<?php

namespace CoreBundle\Services\BoxOneToMany;

use CoreBundle\Services\BoxOneToMany\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToMany\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToMany\Builder\BoxRightMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxOneToMany
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