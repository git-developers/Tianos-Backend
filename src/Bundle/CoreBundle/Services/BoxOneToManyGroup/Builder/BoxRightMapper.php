<?php

namespace CoreBundle\Services\BoxOneToManyGroup\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;

class BoxRightMapper extends Base
{
    const BOX_ID = 'box-right-';
    const BOX_SEARCH = 'box-right-search-value';
    const BOX_CLASS = 'warning';
    const BADGE_CLASS = 'bg-orange-active';
    const BOX_LI_CLASS = 'box-right-li-sortable';
    const BOX_VALUE = 'box-right-selected-value';

//    protected $defaults;

    public function __construct()
    {
        $this->defaults = [
            'class_path' => null,
            'group_name' => null,
            'limit' => 10,
            'badge_class' => self::BADGE_CLASS,

            'box_id' => self::BOX_ID . uniqid(),
            'box_icon' => null,
            'box_title' => null,
            'box_search' => self::BOX_SEARCH,
            'box_class' => self::BOX_CLASS,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_value' => self::BOX_VALUE,

            'route_search' => null,

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
        return $this->handleSelectedIdSingle($request, self::BOX_VALUE);
    }

}



