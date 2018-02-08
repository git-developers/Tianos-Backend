<?php

namespace CoreBundle\Services\BoxOneToManyAssoc;

use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxMapper;
use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxLeftMapper;
use CoreBundle\Services\BoxOneToManyAssoc\Builder\BoxRightMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxOneToManyAssoc
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
        return new BoxRightMapper();
    }

}