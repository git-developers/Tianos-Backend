<?php

namespace CoreBundle\Services\TreeToAssign\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxMapper extends Base
{
    const BODY_CSS = 'body-tree';
    const FORM_NAME = 'form';
    const SEPARATOR = '#';

    const ID_ASSOCIATIVE = 'id_associative';
    const ID_LEFT_HAS_RIGHT = 'left_has_right';

    const BOX_MAIN_DIV = 'box-main-div';
    const BOX_MAIN_UL = 'box-main-ul';
    const BOX_CHILD_UL = 'box-child-ul-';

    const ACTION_CREATE = 'create';
    const ACTION_DELETE = 'delete';

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'body_css' => self::BODY_CSS,
            'form_name' => self::FORM_NAME,

            'box_main_div' => self::BOX_MAIN_DIV,
            'box_main_ul' => self::BOX_MAIN_UL,
            'box_child_ul' => self::BOX_CHILD_UL,
            'box_separator' => self::SEPARATOR,

            'action_create' => self::ACTION_CREATE,
            'action_delete' => self::ACTION_DELETE,

            'assoc_class_path' => null,
            'assoc_group_name' => null,
            'assoc_entity' => null,
            'assoc_boxleft_collection' => null,
            'assoc_boxright_collection' => null,
            'assoc_group_name_associative' => self::ID_ASSOCIATIVE,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;
        return $this;
    }

    public function getIdsToDelete($boxRightIds)
    {
        if(empty($boxRightIds)){
            return;
        }

        $ids = [];
        foreach ($boxRightIds as $key => $value){
            if($this->getAction($value) == self::ACTION_DELETE){
                $ids[] = $this->getEntityId($value);
            }
        }

        return $ids;
    }

    public function getIdsToCreate($boxRightIds)
    {
        if(empty($boxRightIds)){
            return;
        }

        $ids = [];
        foreach ($boxRightIds as $key => $value){
            if($this->getAction($value) == self::ACTION_CREATE){
                $ids[] = $this->getEntityId($value);
            }
        }

        return $ids;
    }

    public function getEntityId($value)
    {
        if(empty($value)){
            return;
        }

        list($first) = array_pad(explode(self::SEPARATOR, $value), 4, null);
        return $first;
    }

    public function getAction($value)
    {
        if(empty($value)){
            return;
        }

        list($first, $last) = array_pad(explode(self::SEPARATOR, $value), 4, null);
        return $last;
    }

}



