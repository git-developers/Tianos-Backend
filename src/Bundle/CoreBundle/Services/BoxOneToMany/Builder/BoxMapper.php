<?php

namespace CoreBundle\Services\BoxOneToMany\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;


class BoxMapper extends Base
{
    const BODY_CSS = 'body-box-one-two-many';
    const FORM_NAME = 'form';
    const SEPARATOR = '#';

    const MODAL_INFO_ID = 'modal-info';
    const MODAL_SIZE_LARGE = 'modal-lg';

    const ACTION_CREATE = 'create';
    const ACTION_DELETE = 'delete';

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'body_css' => self::BODY_CSS,
            'form_name' => self::FORM_NAME,
            'box_separator' => self::SEPARATOR,

            'modal_info_id' => self::MODAL_INFO_ID,
            'modal_info_size' => self::MODAL_SIZE_LARGE,
            'route_info' => null,
            'template_info' => null,

            'collection_get' => null,
            'collection_add' => null,
            'collection_remove' => null,

            'action_create' => self::ACTION_CREATE,
            'action_delete' => self::ACTION_DELETE,

            'assoc_group_name' => null,
            'assoc_group_name_key' => null,
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



