<?php

declare(strict_types=1);

namespace Bundle\OrderBundle\Renderer;

use Bundle\OrderBundle\Form\Registry\FormTypeRegistryInterface;
use Bundle\CoreBundle\Services\Button;
use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
use Component\OneToMany\FieldTypes\FieldTypeInterface;
use Component\Order\Renderer\OrderRendererInterface;
use Component\OneToMany\View\OneToManyViewInterface;
use Component\Registry\ServiceRegistryInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TwigOrderRenderer implements OrderRendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var ServiceRegistryInterface
     */
    private $fieldsRegistry;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormTypeRegistryInterface
     */
    private $formTypeRegistry;

    /**
     * @var string
     */
    private $defaultTemplate;

    /**
     * @var array
     */
    private $actionTemplates;

    /**
     * @var array
     */
    private $filterTemplates;

    /**
     * @param \Twig_Environment $twig
     * @param ServiceRegistryInterface $fieldsRegistry
     * @param FormFactoryInterface $formFactory
     * @param FormTypeRegistryInterface $formTypeRegistry
     * @param string $defaultTemplate
     * @param array $actionTemplates
     * @param array $filterTemplates
     */
    public function __construct(
        \Twig_Environment $twig,
        ServiceRegistryInterface $fieldsRegistry,
        FormFactoryInterface $formFactory,
        FormTypeRegistryInterface $formTypeRegistry,
        string $defaultTemplate,
        array $actionTemplates = [],
        array $filterTemplates = []
    ) {
        $this->twig = $twig;
        $this->fieldsRegistry = $fieldsRegistry;
        $this->formFactory = $formFactory;
        $this->formTypeRegistry = $formTypeRegistry;
        $this->defaultTemplate = $defaultTemplate;
        $this->actionTemplates = $actionTemplates;
        $this->filterTemplates = $filterTemplates;
    }

    //    JAFETH
    public function orderQuantity(array $orders = [], $id) // Button $button,
    {

//        echo "POLLO: 222: <pre>";
//        print_r($oneToManyLeft);
//        exit;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }

}
