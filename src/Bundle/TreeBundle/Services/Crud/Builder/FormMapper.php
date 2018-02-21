<?php

namespace Bundle\TreeBundle\Services\Crud\Builder;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

//class FormMapper extends Base
class FormMapper
{

    protected $defaults;

    const CREATE_NAME = 'form-create';
    const CREATE_CHILD_NAME = 'form-create-child';
    const EDIT_NAME = 'form-edit';
    const DELETE_NAME = 'form-delete';
    const DELETE_INPUT_ID = 'input-role-id';

    public function __construct(Router $router, RequestStack $requestStack)
    {

//        parent::__construct($router, $requestStack);

        $this->defaults = [

            'create_name' => self::CREATE_NAME,
            'create_child_name' => self::CREATE_CHILD_NAME,
            'edit_name' => self::EDIT_NAME,
            'delete_name' => self::DELETE_NAME,
            'data' => [],
//            'type' => null,
        ];
    }

    public function getDefaults()
    {
        return $this->defaults;
    }

//    public function add($key, $value = null, array $options = [])
//    {
//        $this->isValidKey($key, $this->defaults);
//        $this->defaults[$key] = $value;
//        return $this;
//    }
}



