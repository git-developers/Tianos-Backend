<?php

namespace Bundle\GridBundle\Services\Crud;

use Bundle\GridBundle\Services\Crud\Builder\ModalMapper;
use Bundle\GridBundle\Services\Crud\Builder\FormMapper;
use Bundle\GridBundle\Services\Crud\Builder\ButtonHeaderMapper;
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

    public function getModalMapper()
    {
        return new ModalMapper($this->router, $this->requestStack);
    }

    public function getFormMapper()
    {
        return new FormMapper($this->router, $this->requestStack);
    }

    public function getDataTableMapper()
    {
        return new DataTableMapper();
    }

    public function getButtonHeaderMapper(array $buttons = [])
    {
        return new ButtonHeaderMapper($buttons);
    }

}