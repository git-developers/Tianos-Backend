<?php

namespace Bundle\GridBundle\Services\Crud\Builder;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

//class ModalMapper extends Base
class ModalMapper
{

    protected $defaults;

    const MODAL_SIZE_LARGE = 'modal-lg';
    const MODAL_CREATE_ID = 'modal-create';
    const MODAL_CREATE_CHILD_ID = 'modal-create-child';
    const MODAL_EDIT_ID = 'modal-edit';
    const MODAL_DELETE_ID = 'modal-delete';
    const MODAL_VIEW_ID = 'modal-view';
    const MODAL_INFO_ID = 'modal-info';

    public function __construct(Router $router, RequestStack $requestStack)
    {

//        parent::__construct($router, $requestStack);

        $this->defaults = [

            'modal_info_size' => self::MODAL_SIZE_LARGE,

            'modal_edit_id' => self::MODAL_EDIT_ID,
            'modal_edit_size' => null,

            'modal_delete_id' => self::MODAL_DELETE_ID,
            'modal_delete_size' => null,

            'modal_create_id' => self::MODAL_CREATE_ID,
            'modal_create_size' => null,
            'modal_create_child_id' => self::MODAL_CREATE_CHILD_ID,
            'modal_create_child_size' => null,

            'modal_view_id' => self::MODAL_VIEW_ID,
            'modal_view_size' => null,
            'modal_info_id' => self::MODAL_INFO_ID,
            'modal_info_size' => null,
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



