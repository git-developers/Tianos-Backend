<?php

namespace CoreBundle\Services\Template\Builder;

use CoreBundle\Services\Common\Base;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class TemplateMapper extends Base
{
    const BODY_CSS = 'body-template';

    const MODAL_SIZE_LARGE = 'modal-lg';
    const MODAL_INFO_ID = 'modal-info';

    protected $buttonHeader;
    protected $settings;

    public function __construct(Router $router, RequestStack $requestStack)
    {

        parent::__construct($router, $requestStack);

        $this->defaults = [
            'body_css' => self::BODY_CSS,
            'entity' => null,
            'class_path' => null,
            'group_name' => null,

            'route_info' => null,

            'template_info' => null,

            'modal_info_id' => self::MODAL_INFO_ID,
            'modal_info_size' => self::MODAL_SIZE_LARGE,

            'button_header' => $this->buttonHeader,
        ];

    }

    public function addButtonHeader(array $actions = [])
    {
        $button = new Button();

        $buttons = [
            'info' => $button->info(),
        ];

        foreach ($actions as $key => $value){
            if(array_key_exists($value, $buttons)){
                $this->buttonHeader[] = $buttons[$value];
            }
        }

        return $this;
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
    public function getButtonHeader()
    {
        return $this->buttonHeader;
    }

    /**
     * @param mixed $buttonHeader
     */
    public function setButtonHeader($buttonHeader)
    {
        $this->buttonHeader = $buttonHeader;
    }

    public function getSettings()
    {
//        return $this->settings;
        return [
            [
                [
                    'name' => 'General',
                    'name_sub' => 'settings',
                    'icon' => 'cog',
                    'path' => '',
                ],
                [
                    'name' => 'Editar',
                    'name_sub' => 'paginas',
                    'icon' => 'pencil',
                    'path' => 'backend_setupedittemplate_index',
                ],
                [
                    'name' => 'Favicon',
                    'name_sub' => 'imagen',
                    'icon' => 'smile-o',
                    'path' => '',
                ],
            ],
            [
                [
                    'name' => 'Seo',
                    'name_sub' => 'search engine optimization',
                    'icon' => 'black-tie',
                    'path' => '',
                ],
                [
                    'name' => 'Analytics',
                    'name_sub' => 'Google Analytics',
                    'icon' => 'line-chart',
                    'path' => '',
                ],
                [
                    'name' => 'eeeeeee',
                    'name_sub' => 'rrrrrrrrr',
                    'icon' => 'send-o',
                    'path' => '',
                ],
            ],
        ];
    }
}



