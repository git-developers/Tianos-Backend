<?php

namespace CoreBundle\Services\Crud;

use CoreBundle\Services\Crud\Builder\CrudMapper;
use CoreBundle\Services\Crud\Builder\DataTableMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Crud
{

    protected $requestStack;
    protected $router;

    public function __construct(Router $router, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->router = $router;
    }

    public function getCrudMapper()
    {
        return new CrudMapper($this->router, $this->requestStack);
    }

    public function getDataTableMapper()
    {
        return new DataTableMapper();
    }

}