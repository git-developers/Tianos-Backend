<?php

declare(strict_types=1);

namespace Bundle\OrderBundle\Twig;

use Bundle\OrderBundle\Templating\Helper\OrderHelper;
use Twig_Environment;

final class OrderExtension extends \Twig_Extension
{
    /**
     * @var OrderHelper
     */
    private $orderinHelper;

    /**
     * @param OrderHelper $OrderHelper
     */
    public function __construct(OrderHelper $orderinHelper)
    {
        $this->orderinHelper = $orderinHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_order_quantity', [$this->orderinHelper, 'orderQuantity']),
        ];
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}
