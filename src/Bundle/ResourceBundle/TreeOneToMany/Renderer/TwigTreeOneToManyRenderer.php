<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\TreeOneToMany\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\TreeOneToMany\Parser\OptionsParserInterface;
use Component\TreeOneToMany\Definition\Action;
use Component\TreeOneToMany\Definition\Field;
use Component\TreeOneToMany\Definition\Filter;
use Component\TreeOneToMany\Renderer\TreeOneToManyRendererInterface;
use Component\TreeOneToMany\View\TreeOneToManyViewInterface;

final class TwigTreeOneToManyRenderer implements TreeOneToManyRendererInterface
{
    /**
     * @var OneToManyRendererInterface
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
     * @param OneToManyRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        TreeOneToManyRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }


    /*
    const CLOSED_LEFT = '<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>';
    const CLOSED_RIGHT_DEFAULT = '<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>';
    const CLOSED_RIGHT_OUTLINE = '<button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cerrar</button>';
    const SAVE = '<button type="submit" class="btn btn-outline">Guardar</button>';
    const CHANGE_PASSWORD = '<button type="submit" class="btn btn-outline">Cambiar password</button>';
    const DELETE = '<button type="submit" class="btn btn-outline">Eliminar</button>';
     */

    //JAFETH
    //    JAFETH
    public function boxRightIsAssigned(array $oneToManyLeft = [], $id) // Button $button,
    {

//        echo "POLLO:: <pre>";
//        print_r($oneToManyLeft);
//        exit;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

    public function renderModalFooter(?string $action = null)
    {
        switch ($action){
            case Action::EDIT:
            case Action::CREATE:
            case Action::CREATE_CHILD:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_1.html.twig';
//                return self::CLOSED_LEFT . self::SAVE;
                break;
            case Action::CHANGE_PASSWORD:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_2.html.twig';
//                return self::CLOSED_LEFT . self::CHANGE_PASSWORD;
                break;
            case Action::DELETE:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_3.html.twig';
//                return self::CLOSED_LEFT . self::DELETE;
                break;
            case Action::VIEW:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_4.html.twig';
//                return self::CLOSED_RIGHT_DEFAULT;
                break;
            case Action::INFO:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_5.html.twig';
//                return self::CLOSED_RIGHT_OUTLINE;
                break;
            default:
                $template = '@Ui/OneToMany/Button/Footer/_modal_button_0.html.twig';
        }

        return (string) $this->twig->render($template, [
            'action' => $action,
        ]);
    }

    public function renderButton(Button $button, ?string $template = null)
    {
        //JAFETH
        return (string) $this->twig->render($template, [
            'button' => $button,
        ]);
    }
    //JAFETH




    /**
     * {@inheritdoc}
     */
    public function render(TreeOneToManyViewInterface $gridView, ?string $template = null): string
    {
        return (string) $this->gridRenderer->render($gridView, $template);
    }

    /**
     * {@inheritdoc}
     */
    public function renderField(TreeOneToManyViewInterface $gridView, Field $field, $data): string
    {
        return (string) $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function renderAction(TreeOneToManyViewInterface $gridView, Action $action, $data = null): string
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
    public function renderFilter(TreeOneToManyViewInterface $gridView, Filter $filter): string
    {
        return (string) $this->gridRenderer->renderFilter($gridView, $filter);
    }
}
