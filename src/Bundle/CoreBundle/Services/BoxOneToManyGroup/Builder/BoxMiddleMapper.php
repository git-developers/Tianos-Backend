<?php

namespace CoreBundle\Services\BoxOneToManyGroup\Builder;

use Symfony\Component\HttpFoundation\Request;
use CoreBundle\Services\Common\Base;

class BoxMiddleMapper extends Base
{
    const BOX_ID = 'box-middle-';
    const BOX_CLASS = 'success';

//    protected $defaults;

    public function __construct()
    {
        $this->defaults = [
            'box_id' => self::BOX_ID . uniqid(),
            'box_icon' => null,
            'box_title' => null,
            'box_class' => self::BOX_CLASS,

            'route_assign_item' => null,
            'route_unassign_item' => null,
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

}



