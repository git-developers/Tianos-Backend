<?php

namespace Bundle\GridBundle\Services\Crud;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Bundle\GridBundle\Services\Crud\Builder\FormMapper;
use Bundle\GridBundle\Services\Crud\Builder\ModalMapper;
use Bundle\ResourceBundle\Controller\RequestConfiguration;
use Bundle\GridBundle\Services\Crud\Builder\DataTableMapper;
use Bundle\GridBundle\Services\Crud\Builder\ButtonHeaderMapper;

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

    public function getDataTableMapper(array $grid = [])
    {
        return new DataTableMapper($grid);
    }

    public function getButtonHeaderMapper(array $grid = [])
    {
        return new ButtonHeaderMapper($grid);
    }

}