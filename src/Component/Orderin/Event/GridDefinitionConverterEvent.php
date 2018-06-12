<?php

declare(strict_types=1);

namespace Component\Orderin\Event;

use Component\Orderin\Definition\Orderin;
use Symfony\Component\EventDispatcher\Event;

final class OrderinDefinitionConverterEvent extends Event
{
    /**
     * @var Orderin
     */
    private $grid;

    /**
     * @param Orderin $grid
     */
    public function __construct(Orderin $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @return Orderin
     */
    public function getOrderin(): Orderin
    {
        return $this->grid;
    }
}
