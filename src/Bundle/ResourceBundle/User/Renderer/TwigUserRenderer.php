<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\User\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\User\Parser\OptionsParserInterface;
use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\User\Renderer\UserRendererInterface;
use Component\Grid\View\GridViewInterface;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;

final class TwigUserRenderer implements UserRendererInterface
{
    /**
     * @var GridRendererInterface
     */
    private $gridRenderer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var OptionsParserInterface
     */
    private $optionsParser;

    /**
     * @var array
     */
    private $actionTemplates;

    /**
     * @param GridRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        UserRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }

    //        JAFETH
    public function profileAboutMe(?string $aboutMe = null) // Button $button,
    {
        return $this->twig->render($aboutMe ?: $this->defaultTemplate, ['template' => $aboutMe]);
    }
}
