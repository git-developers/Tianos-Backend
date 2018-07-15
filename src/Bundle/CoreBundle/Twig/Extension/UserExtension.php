<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Twig\Extension;

use Bundle\UserBundle\Entity\User;
use Twig_Environment;

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
        $name = !is_null($name) ? substr($name, $start, $length) : '';

        $lastName = $user->getLastName();
        $lastName = !is_null($lastName) ? substr($lastName, $start, $length) : '';

        return $name .' '. $lastName;
    }

    public function getName()
    {
        return 'user_extension';
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }
}

