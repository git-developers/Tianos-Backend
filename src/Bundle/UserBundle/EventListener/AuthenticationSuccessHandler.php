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
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Symfony\Component\Security\Core\Security;


class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    private $em;
    private $router;

//    public function __construct(EntityManager $em, RouterInterface $router)
    public function __construct(ContainerInterface $container, RouterInterface $router)
    {
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
		    foreach ($pointOfSale->getUser() as $key => $userPdv) {
			    if ($user->getId() == $userPdv->getId()) {
				    $request->attributes->set(User::USER_BELONGS_TO_PDV, true);
			    }
		    }
		
		    $user->setPointOfSaleActive($pointOfSale);
		    $token->setUser($user);
        }
	    
	    $this->onAuthenticationSuccess($request, $token);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
	
	    $user = $token->getUser();
	
	    if ($this->isGranted(Role::ROLE_PDV_ADMIN)) {
	    	
		    $referer = $this->router->generate('backend_default_pdv_index');
		    $userBelongsToPdv = $request->attributes->get(User::USER_BELONGS_TO_PDV);

		    if (!$userBelongsToPdv) {
		    	
			    $o = new \stdClass();
			    $o->messageKey = 'El usuario no esta asociado al Punto de venta.';
			    $o->messageData = [];
			    
			    $request->getSession()->set(Security::AUTHENTICATION_ERROR, $o);
			    $referer = $this->router->generate('backend_security_pdv_login', ['slug' => $user->getPointOfSaleActive()->getSlug()]);
		    }
	    }
	
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

