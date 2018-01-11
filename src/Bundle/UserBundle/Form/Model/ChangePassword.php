<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Form\Model;

class ChangePassword
{
    /**
     * @var string|null
     */
    private $currentPassword;

    /**
     * @var string|null
     */
    private $newPassword;

    /**
     * @return string|null
     */
    public function getCurrentPassword(): ?string
    {
        return $this->currentPassword;
    }

    /**
     * @param string|null $password
     */
    public function setCurrentPassword(?string $password): void
    {
        $this->currentPassword = $password;
    }

    /**
     * @return string
     */
    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    /**
     * @param string $password
     */
    public function setNewPassword(?string $password): void
    {
        $this->newPassword = $password;
    }
}
