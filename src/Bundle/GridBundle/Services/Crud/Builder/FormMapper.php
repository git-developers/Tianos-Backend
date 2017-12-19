<?php

namespace Bundle\GridBundle\Services\Crud\Builder;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

//class FormMapper extends Base
class FormMapper
{

    protected $defaults;

    const FORM_CREATE_NAME = 'form-create';
    const FORM_CREATE_CHILD_NAME = 'form-create-child';
    const FORM_EDIT_NAME = 'form-edit';
    const FORM_DELETE_NAME = 'form-delete';
    const FORM_DELETE_INPUT_ID = 'input-role-id';

    public function __construct(Router $router, RequestStack $requestStack)
    {

//        parent::__construct($router, $requestStack);

        $this->defaults = [

            'form_create_name' => self::FORM_CREATE_NAME,
            'form_create_child_name' => self::FORM_CREATE_CHILD_NAME,
            'form_edit_name' => self::FORM_EDIT_NAME,
            'form_delete_name' => self::FORM_DELETE_NAME,
            'form_data' => [],
            'form_type' => null,

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



