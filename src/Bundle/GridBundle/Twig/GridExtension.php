<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Twig;

use Bundle\GridBundle\Templating\Helper\GridHelper;

final class GridExtension extends \Twig_Extension
{
    /**
     * @var GridHelper
     */
    private $gridHelper;

    /**
     * @param GridHelper $gridHelper
     */
    public function __construct(GridHelper $gridHelper)
    {
        $this->gridHelper = $gridHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_Function('tianos_grid_render_button', [$this->gridHelper, 'renderButton'], ['is_safe' => ['html']]),
            new \Twig_Function('sylius_grid_render', [$this->gridHelper, 'renderGrid'], ['is_safe' => ['html']]),
            new \Twig_Function('sylius_grid_render_field', [$this->gridHelper, 'renderField'], ['is_safe' => ['html']]),
            new \Twig_Function('sylius_grid_render_action', [$this->gridHelper, 'renderAction'], ['is_safe' => ['html']]),
            new \Twig_Function('sylius_grid_render_filter', [$this->gridHelper, 'renderFilter'], ['is_safe' => ['html']]),
        ];
    }
}
