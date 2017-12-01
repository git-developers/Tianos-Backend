<?php

namespace CoreBundle\Services\ListHasTree\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;

class BoxLeftMapper extends Base
{
    const BOX_ID = 'box-left-';
    const BOX_LI_ID = 'box-left-li';
    const BOX_VALUE = 'box-left-selected-value';
    const BOX_SEARCH = 'box-left-search-value';
    const BOX_CLASS = 'primary';
    const BADGE_CLASS = 'bg-blue';
    const BOX_LI_CLASS = 'bg-light-blue-active';

    public function __construct()
    {
        $this->defaults = [
            'class_path' => null,
            'group_name' => null,
            'badge_class' => self::BADGE_CLASS,
            'limit' => 10,

            'box_id' => self::BOX_ID . uniqid(),
            'box_li_id' => self::BOX_LI_ID,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_title' => null,
            'box_icon' => null,
            'box_class' => self::BOX_CLASS,
            'box_value' => self::BOX_VALUE,
            'box_search' => self::BOX_SEARCH,

            'route_search' => null,
            'route_select_item' => null,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;

        return $this;
    }

    public function handleSearchValue(Request $request)
    {
        return $this->handleSearchValueBase($request, self::BOX_SEARCH);
    }

    public function handleSelectedId(Request $request)
    {
        return $this->handleSelectedIdSingle($request, self::BOX_VALUE);
    }

}



