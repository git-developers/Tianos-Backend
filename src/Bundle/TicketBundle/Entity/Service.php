<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Entity;

/**
 * Service.
 */
class Service
{

    /**
     * @var int
     */
    private $code;

    /**
     * Set code
     *
     * @param int $code
     *
     * @return Service
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

}

