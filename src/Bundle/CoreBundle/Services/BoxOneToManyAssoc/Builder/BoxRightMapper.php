<?php

namespace CoreBundle\Services\BoxOneToManyAssoc\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;

class BoxRightMapper extends Base
{
    const BOX_ID = 'box-right-';
    const BOX_SEARCH = 'box-right-search-value';
    const BOX_CLASS = 'warning';

    const BOX_VALUE = 'box-right-selected-value';
    const BOX_VALUE_HIDDEN = 'box-right-selected-value-hidden';

    const BOX_LI_ID = 'box-right-li';
    const BOX_LI_CLASS = 'bg-orange';

    const BADGE_CLASS = 'bg-orange-active';

    const MODAL_EDIT_ID = 'modal-edit';
    const MODAL_EDIT_FORM_NAME = 'form-edit';
    const MODAL_SIZE_LARGE = 'modal-lg';

//    protected $defaults;

    public function __construct()
    {
        $this->defaults = [
            'limit' => 10,
            'class_path' => null,
            'group_name' => null,
            'badge_class' => self::BADGE_CLASS,

            'box_id' => self::BOX_ID . uniqid(),
            'box_icon' => null,
            'box_title' => null,
            'box_class' => self::BOX_CLASS,
            'box_search' => self::BOX_SEARCH,
            'box_li_id' => self::BOX_LI_ID,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_value' => self::BOX_VALUE,
            'box_value_hidden' => self::BOX_VALUE_HIDDEN,

            'route_search' => null,
            'route_select_item' => null,

            'modal_edit_id' => self::MODAL_EDIT_ID,
            'modal_edit_size' => null,
            'modal_edit_form_name' => self::MODAL_EDIT_FORM_NAME,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;

        return $this;
    }

//    /**
//     * @return mixed
//     */
//    public function getDefaults()
//    {
//        return $this->defaults;
//    }
//
//    /**
//     * @param mixed $defaults
//     */
//    public function setDefaults($defaults)
//    {
//        $this->defaults = $defaults;
//    }

    public function handleSearchValue(Request $request)
    {
        return $this->handleSearchValueBase($request, self::BOX_SEARCH);
    }

    public function handleSelectedId(Request $request)
    {
        return $this->handleSelectedIdArray($request, self::BOX_VALUE_HIDDEN);
    }

}



