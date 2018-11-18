<?php

declare(strict_types=1);

namespace Bundle\UserBundle\EventListener;

use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;


class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
	
	/**
	 * {@inheritdoc}
	 */
	public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
	{
		
		
		echo "POLLO:: <pre>";
		print_r(3333);
		exit;
		
		
		
		
		if ($request->isXmlHttpRequest()) {
			return new JsonResponse(['success' => false, 'message' => $exception->getMessageKey()], 401);
		}
		
		return;
//		return parent::onAuthenticationFailure($request, $exception);
	}

}

