<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Model;

class PasswordReset
{
    /**
     * @var string|null
     */
    private $password;

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
}
