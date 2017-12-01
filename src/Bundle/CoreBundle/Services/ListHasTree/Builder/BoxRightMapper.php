<?php

namespace CoreBundle\Services\ListHasTree\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxRightMapper extends Base
{
    const BOX_ID = 'box-right-';
    const BOX_LI_ID = 'box-right-li';
    const BOX_LI_CLASS = 'bg-orange';
    const BOX_VALUE = 'box-right-selected-value';
    const BOX_CLASS = 'warning';
    const BADGE_CLASS = 'bg-orange-active';

    const MODAL_SIZE_LARGE = 'modal-lg';

    const MODAL_ASSIGN_ID = 'modal-assign';
    const MODAL_ASSIGN_EDIT_ID = 'modal-assign-edit';
    const MODAL_ASSIGN_CHILD_ID = 'modal-assign-child';
    const MODAL_ASSIGN_VIEW_ID = 'modal-assign-view';
    const MODAL_UNASSIGN_CHILD_ID = 'modal-unassign-child';
    const MODAL_ASSIGN_CLASS = 'modal-assign-class';
    const MODAL_ASSIGN_INPUT = 'modal-assign-input';

    const FORM_ASSIGN_NAME = 'form-assign';
    const FORM_ASSIGN_EDIT_NAME = 'form-assign-edit';
    const FORM_ASSIGN_CHILD_NAME = 'form-assign-child';

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'class_path' => null,
            'group_name' => null,
            'badge_class' => self::BADGE_CLASS,

            'box_id' => self::BOX_ID . uniqid(),
            'box_li_id' => self::BOX_LI_ID,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_title' => null,
            'box_icon' => null,
            'box_class' => self::BOX_CLASS,
            'box_value' => self::BOX_VALUE,

            'modal_assign_class' => self::MODAL_ASSIGN_CLASS,
            'modal_assign_input' => self::MODAL_ASSIGN_INPUT,

            'modal_assign_id' => self::MODAL_ASSIGN_ID,
            'modal_assign_size' => null,

            'modal_assign_edit_id' => self::MODAL_ASSIGN_EDIT_ID,
            'modal_assign_edit_size' => null,

            'modal_assign_child_id' => self::MODAL_ASSIGN_CHILD_ID,
            'modal_assign_child_size' => null,

            'modal_assign_view_id' => self::MODAL_ASSIGN_VIEW_ID,
            'modal_assign_view_size' => null,

            'modal_unassign_child_id' => self::MODAL_UNASSIGN_CHILD_ID,

            'route_assign' => null,
            'route_assign_view' => null,
            'route_assign_edit' => null,
            'route_assign_child' => null,
            'route_unassign' => null,

            'form_assign_name' => self::FORM_ASSIGN_NAME,
            'form_assign_edit_name' => self::FORM_ASSIGN_EDIT_NAME,
            'form_assign_child_name' => self::FORM_ASSIGN_CHILD_NAME,

            'template_create' => null,
            'template_edit' => null,
            'template_view' => null,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;

        return $this;
    }

}



