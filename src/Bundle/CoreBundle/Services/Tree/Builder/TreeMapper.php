<?php

namespace CoreBundle\Services\Tree\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class TreeMapper extends Base
{

    const BODY_CSS = 'body-tree';
    const INPUT = 'input-';

    const BOX_MAIN_DIV = 'box-main-div';
    const BOX_MAIN_UL = 'box-main-ul';
    const BOX_CHILD_UL = 'box-child-ul-';

    const MODAL_CREATE_ID = 'modal-create';
    const MODAL_CREATE_CHILD_ID = 'modal-create-child';
    const MODAL_EDIT_ID = 'modal-edit';
    const MODAL_DELETE_ID = 'modal-delete';
    const MODAL_VIEW_ID = 'modal-view';

    const FORM_CREATE_NAME = 'form-create';
    const FORM_CREATE_CHILD_NAME = 'form-create-child';
    const FORM_EDIT_NAME = 'form-edit';
    const FORM_DELETE_NAME = 'form-delete';


    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'body_css' => self::BODY_CSS,
            'class_path' => null,
            'group_name' => null,
            'entity' => null,
            'section_title' => null,

            'box_main_div' => self::BOX_MAIN_DIV,
            'box_main_ul' => self::BOX_MAIN_UL,
            'box_child_ul' => self::BOX_CHILD_UL,

            'template_create' => null,
            'template_edit' => null,
            'template_view' => null,

            'route_create' => null,
            'route_create_child' => null,
            'route_edit' => null,
            'route_delete' => null,
            'route_view' => null,
            'route_info' => null,

            'modal_create_id' => self::MODAL_CREATE_ID,
            'modal_create_size' => null,

            'modal_create_child_id' => self::MODAL_CREATE_CHILD_ID,
            'modal_create_child_size' => null,

            'modal_edit_id' => self::MODAL_EDIT_ID,
            'modal_edit_size' => null,

            'modal_delete_id' => self::MODAL_DELETE_ID,
            'modal_delete_size' => null,

            'modal_view_id' => self::MODAL_VIEW_ID,
            'modal_view_size' => null,

            'form_create_name' => self::FORM_CREATE_NAME,
            'form_create_child_name' => self::FORM_CREATE_CHILD_NAME,
            'form_edit_name' => self::FORM_EDIT_NAME,
            'form_delete_name' => self::FORM_DELETE_NAME,
            'form_type' => null,
            'form_data' => [],
        ];
    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;
        return $this;
    }

}



