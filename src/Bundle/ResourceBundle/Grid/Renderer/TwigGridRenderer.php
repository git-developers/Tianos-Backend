<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Grid\Renderer;

use Bundle\GridBundle\Services\Crud\Builder\Button;
use Bundle\ResourceBundle\Grid\Parser\OptionsParserInterface;
use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Grid\Renderer\GridRendererInterface;
use Component\Grid\View\GridViewInterface;

final class TwigGridRenderer implements GridRendererInterface
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
        GridRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }

    public function renderButton(Button $button, ?string $template = null)
    {

        //JAFETH
        return (string) $this->twig->render($template, [
            'button' => $button,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function render(GridViewInterface $gridView, ?string $template = null): string
    {
        return (string) $this->gridRenderer->render($gridView, $template);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(GridViewInterface $gridView, Field $field, $data): string
    {
        return (string) $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function renderAction(GridViewInterface $gridView, Action $action, $data = null): string
    {
        $type = $action->getType();
        if (!isset($this->actionTemplates[$type])) {
            throw new \InvalidArgumentException(sprintf('Missing template for action type "%s".', $type));
        }

        $options = $this->optionsParser->parseOptions(
            $action->getOptions(),
            $gridView->getRequestConfiguration()->getRequest(),
            $data
        );

        return (string) $this->twig->render($this->actionTemplates[$type], [
            'grid' => $gridView,
            'action' => $action,
            'data' => $data,
            'options' => $options,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function renderFilter(GridViewInterface $gridView, Filter $filter): string
    {
        return (string) $this->gridRenderer->renderFilter($gridView, $filter);
    }
}
