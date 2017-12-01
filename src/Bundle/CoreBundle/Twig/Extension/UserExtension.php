<?php

namespace Bundle\CoreBundle\Twig\Extension;

use CoreBundle\Entity\User;

class UserExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return [

        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('app_user_name', [$this, 'appUserNameFunction'] ),
        ];
    }

    public function appUserNameFunction(User $user, $start, $length = null)
    {

        $name = $user->getName();
        $lastName = $user->getLastName();

        return substr($name, $start, $length).' '.substr($lastName, $start, $length);
    }

    public function getName()
    {
        return 'user_extension';
    }

}

