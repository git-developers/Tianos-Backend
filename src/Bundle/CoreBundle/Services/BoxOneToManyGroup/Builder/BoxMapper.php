<?php

namespace CoreBundle\Services\BoxOneToManyGroup\Builder;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class BoxMapper extends Base
{
    const BODY_CSS = 'body-box-one-two-many-group';
    const FORM_NAME = 'form';
    const SEPARATOR = '-';
    const ID_ASSOCIATIVE = 'id_associative';
    const ID_LEFT_HAS_RIGHT = 'left_has_right';

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

            'action_create' => self::ACTION_CREATE,
            'action_delete' => self::ACTION_DELETE,

            'collection_get' => null,
            'collection_add' => null,
            'collection_remove' => null,
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;

        return $this;
    }

}



