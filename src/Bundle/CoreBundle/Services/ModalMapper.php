<?php

namespace Bundle\CoreBundle\Services;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

//class ModalMapper extends Base
class ModalMapper
{

    protected $defaults;

    const TITLE = 'Crear item';
    const SIZE_LARGE = 'modal-lg';
    const CREATE_ID = 'modal-create';
    const CREATE_CHILD_ID = 'modal-create-child';
    const EDIT_ID = 'modal-edit';
    const DELETE_ID = 'modal-delete';
    const VIEW_ID = 'modal-view';
    const INFO_ID = 'modal-info';

    public function __construct(Router $router)
    {

//        parent::__construct($router, $requestStack);

        $this->defaults = [

            'title' => self::TITLE,

            'edit_id' => self::EDIT_ID,
            'edit_size' => null,

            'delete_id' => self::DELETE_ID,
            'delete_size' => null,

            'create_id' => self::CREATE_ID,
            'create_size' => null,
            'create_child_id' => self::CREATE_CHILD_ID,
            'create_child_size' => null,

            'view_id' => self::VIEW_ID,
            'view_size' => null,

            'info_id' => self::INFO_ID,
            'info_size' => self::SIZE_LARGE,
        ];
    }

    public function getDefaults(array $defaults = [])
    {
        return array_replace($this->defaults, $defaults);
    }

//    public function add($key, $value = null, array $options = [])
//    {
//        $this->isValidKey($key, $this->defaults);
//        $this->defaults[$key] = $value;
//        return $this;
//    }
}



