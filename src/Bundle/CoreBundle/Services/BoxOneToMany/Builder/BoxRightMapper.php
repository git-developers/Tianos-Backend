<?php

namespace CoreBundle\Services\BoxOneToMany\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxRightMapper extends Base
{
    const BOX_ID = 'box-right-';
    const BOX_LI_ID = 'box-right-li';
    const BOX_LI_CLASS = 'bg-orange';
    const BOX_VALUE = 'box-right-selected-value';
    const BOX_VALUE_HIDDEN = 'box-right-selected-value-hidden';
    const BOX_SEARCH = 'box-right-search-value';
    const BOX_CLASS = 'warning';
    const BADGE_CLASS = 'bg-orange-active';

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'class_path' => null,
            'limit' => 10,
            'group_name' => null,
            'badge_class' => self::BADGE_CLASS,

            'box_id' => self::BOX_ID . uniqid(),
            'box_li_id' => self::BOX_LI_ID,
            'box_li_class' => self::BOX_LI_CLASS,
            'box_title' => null,
            'box_icon' => null,
            'box_class' => self::BOX_CLASS,
            'box_value' => self::BOX_VALUE,
            'box_value_hidden' => self::BOX_VALUE_HIDDEN,
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
        return $this->handleSelectedIdArray($request, self::BOX_VALUE_HIDDEN);
    }

}



