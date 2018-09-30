<?php

namespace Bundle\CoreBundle\Services;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class ModalMapper
{

    protected $defaults;

    const TITLE = 'Crear item';
    const SIZE_LARGE = 'modal-lg';
    const CREATE_ID = 'modal-create';
    const CREATE_CHILD_ID = 'modal-create-child';
    const EDIT_ID = 'modal-edit';
    const DELETE_ID = 'modal-delete';
    const VIEW_ID = 'modal-view';
    const INFO_ID = 'modal-info';
    const WATCH_ID = 'watch-button-id';
    const PROFILE_ID = 'profile-button-id';
    const POINT_OF_SALE_ADD_USER = 'pointofsale-add-user';
    const POINT_OF_SALE_ADD_MODULE = 'pointofsale-add-module';
    const POINT_OF_SALE_ADD_PDV_CHILD = 'pointofsale-add-pdv-child';
    const CHANGE_PASSWORD = 'change_password';

    public function __construct(Router $router)
    {

        $this->defaults = [

            'title' => self::TITLE,

            'edit_id' => self::EDIT_ID,
            'edit_size' => null,

            'delete_id' => self::DELETE_ID,
            'delete_size' => null,

            'create_id' => self::CREATE_ID,
            'create_size' => null,
            'create_child_id' => self::CREATE_CHILD_ID,
            'create_child_size' => null,

            'view_id' => self::VIEW_ID,
            'view_size' => null,

            'info_id' => self::INFO_ID,
            'info_size' => self::SIZE_LARGE,

            'watch_id' => self::WATCH_ID,
            'profile_id' => self::PROFILE_ID,

            'point_of_sale_add_user' => self::POINT_OF_SALE_ADD_USER,
            'point_of_sale_add_module' => self::POINT_OF_SALE_ADD_MODULE,
            'point_of_sale_add_pdv_child' => self::POINT_OF_SALE_ADD_PDV_CHILD,

            'change_password' => self::CHANGE_PASSWORD,
        ];
    }

    public function getDefaults(array $defaults = [])
    {
        return array_replace($this->defaults, $defaults);
    }

}



