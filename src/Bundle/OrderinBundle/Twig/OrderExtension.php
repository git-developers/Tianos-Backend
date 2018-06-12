<?php

declare(strict_types=1);

namespace Bundle\OrderinBundle\Twig;

use Bundle\OrderinBundle\Templating\Helper\OrderinHelper;
use Twig_Environment;

final class OrderExtension extends \Twig_Extension
{
    /**
     * @var OrderinHelper
     */
    private $orderinHelper;

    /**
     * @param OrderinHelper $OrderinHelper
     */
    public function __construct(OrderinHelper $orderinHelper)
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
