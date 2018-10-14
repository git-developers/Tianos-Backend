<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Bundle\RoleBundle\Entity\Role;


class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    private $em;
    private $router;

//    public function __construct(EntityManager $em, RouterInterface $router)
    public function __construct(ContainerInterface $container, RouterInterface $router)
    {
//        $this->em = $em;
        $this->container = $container;
        $this->router = $router;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
	
	    $user = $token->getUser();
	    
	    $pointOfSale = $this->container->get('tianos.repository.pointofsale')->find($request->get('pointOfSale'));

	    if ($pointOfSale) {
	        $user->setPointOfSaleActive($pointOfSale);
		    $token->setUser($user);
        }
	
	    $this->onAuthenticationSuccess($request, $token);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $referer = $this->router->generate('backend_default_pdv_index');

        if ($this->isGranted(Role::ROLE_SUPER_ADMIN)) {
            $referer = $this->router->generate('backend_default_super_index');
        }

        return new RedirectResponse($referer);
    }

    private function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

}

