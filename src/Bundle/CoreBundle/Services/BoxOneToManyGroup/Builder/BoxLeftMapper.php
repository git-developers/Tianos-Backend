<?php

namespace CoreBundle\Services\BoxOneToManyGroup\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;

class BoxLeftMapper extends Base
{
    const BOX_ID = 'box-left-';
    const BOX_SEARCH = 'box-left-search-value';
    const BOX_CLASS = 'primary';
    const BOX_LI_ID = 'box-left-li';
    const BOX_LI_CLASS = 'box-left-class';
    const BOX_VALUE = 'box-left-selected-value';

//    protected $defaults;

    public function __construct()
    {
        $this->defaults = [
            'class_path' => null,
            'group_name' => null,
            'group_name_join' => null,
            'limit' => 10,

            'box_id' => self::BOX_ID . uniqid(),
            'box_icon' => null,
            'box_title' => null,
            'box_search' => self::BOX_SEARCH,
            'box_class' => self::BOX_CLASS,
            'box_li_id' => self::BOX_LI_ID,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_value' => self::BOX_VALUE,

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



