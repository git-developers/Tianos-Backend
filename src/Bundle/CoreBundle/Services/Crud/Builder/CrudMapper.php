<?php

namespace CoreBundle\Services\Crud\Builder;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class CrudMapper extends Base
{

    const BODY_CSS = 'body-crud';
    const TABLE_TR_CLASS = 'row-tr-class';
    const TABLE_TD_CLASS = 'row-td-class';

    const FORM_CREATE_NAME = 'form-create';
    const FORM_CREATE_CHILD_NAME = 'form-create-child';
    const FORM_EDIT_NAME = 'form-edit';
    const FORM_DELETE_NAME = 'form-delete';
    const FORM_DELETE_INPUT_ID = 'input-role-id';

    const MODAL_SIZE_LARGE = 'modal-lg';

    const MODAL_CREATE_ID = 'modal-create';
    const MODAL_CREATE_CHILD_ID = 'modal-create-child';
    const MODAL_EDIT_ID = 'modal-edit';
    const MODAL_DELETE_ID = 'modal-delete';
    const MODAL_VIEW_ID = 'modal-view';
    const MODAL_INFO_ID = 'modal-info';

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [

            'body_css' => self::BODY_CSS,
            'test' => null,
            'class_path' => null,
            'group_name' => null,

            'route_create' => null,
            'route_create_child' => null,
            'route_edit' => null,
            'route_delete' => null,
            'route_view' => null,
            'route_info' => null,

            'section_icon' => null,
            'section_title' => null,
            'section_box_class' => 'primary',

            'table_name' => 'table-' . uniqid(),
            'table_tr_class' => self::TABLE_TR_CLASS,
            'table_td_class' => self::TABLE_TD_CLASS,

            'modal_info_size' => self::MODAL_SIZE_LARGE,
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
            'modal_info_id' => self::MODAL_INFO_ID,
            'modal_info_size' => null,

            'form_create_name' => self::FORM_CREATE_NAME,
            'form_create_child_name' => self::FORM_CREATE_CHILD_NAME,
            'form_edit_name' => self::FORM_EDIT_NAME,
            'form_delete_name' => self::FORM_DELETE_NAME,
            'form_data' => [],
            'form_type' => null,

            'template_create' => null,
            'template_edit' => null,
            'template_view' => null,
            'template_info' => null,
//            'template_delete' => 'CoreBundle:Crud:Template/delete.html.twig',
            'template_delete' => null,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;
        return $this;
    }
}



