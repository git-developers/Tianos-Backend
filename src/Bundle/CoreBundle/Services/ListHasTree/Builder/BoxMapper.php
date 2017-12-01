<?php

namespace CoreBundle\Services\ListHasTree\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;


class BoxMapper extends Base
{
    const BODY_CSS = 'body-list-has-tree';
    const FORM_NAME = 'form';

    const MODAL_INFO_ID = 'modal-info';
    const MODAL_SIZE_LARGE = 'modal-lg';

    const BOX_MAIN_DIV = 'box-main-div';
    const BOX_MAIN_UL = 'box-main-ul';
    const BOX_CHILD_UL = 'box-child-ul-';

    protected $settings;

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'body_css' => self::BODY_CSS,
            'form_name' => self::FORM_NAME,

            'assign_class_path' => null,
            'assign_form_data' => [],
            'assign_form_type' => null,
            'assign_form_edit_type' => null,
            'assign_group_name' => null,
            'assign_group_name_key' => null,

            'modal_info_id' => self::MODAL_INFO_ID,
            'modal_info_size' => self::MODAL_SIZE_LARGE,

            'box_main_div' => self::BOX_MAIN_DIV,
            'box_main_ul' => self::BOX_MAIN_UL,
            'box_child_ul' => self::BOX_CHILD_UL,

            'route_info' => null,
            'template_info' => null,

            'settings' => $this->getSettings(),
        ];

    }

    public function add($key, $value = null, array $options = [])
    {
        $this->isValidKey($key, $this->defaults);
        $this->defaults[$key] = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
//        return $this->settings;
        return [
            'paragraph' => [
                'name' => 'Paragraph',
                'icon' => 'paragraph',
            ],
            'image' => [
                'name' => 'Imagen',
                'icon' => 'image',
            ],
            'video' => [
                'name' => 'Video',
                'icon' => 'youtube-play',
            ],
        ];
    }

    /**
     * @param mixed $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }
}



