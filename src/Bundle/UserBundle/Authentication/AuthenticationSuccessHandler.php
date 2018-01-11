<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Authentication;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

final class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['success' => true, 'username' => $token->getUsername()]);
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}
