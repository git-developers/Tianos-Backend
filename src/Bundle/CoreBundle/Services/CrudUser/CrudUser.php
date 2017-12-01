<?php

namespace CoreBundle\Services\CrudUser;

use CoreBundle\Services\CrudUser\Builder\CrudUserMapper;
use CoreBundle\Services\CrudUser\Builder\DataTableMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class CrudUser
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
        return new CrudUserMapper($this->router, $this->requestStack);
    }

    public function getDataTableMapper()
    {
        return new DataTableMapper();
    }

}