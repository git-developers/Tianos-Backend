<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\UserBundle\Form\Type\UserLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class SecurityController extends Controller
{
    /**
     * Login form action.
     */
    public function loginAction(Request $request): Response
    {
//        /var/www/html/Sylius/src/Sylius/Bundle/ShopBundle/Resources/views/login.html.twig
//        /var/www/html/Sylius/src/Sylius/Bundle/UiBundle/Resources/views/Form/theme.html.twig

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $formType = $options['form'] ?? UserLoginType::class;
        $form = $this->get('form.factory')->createNamed('', $formType);

        return $this->render($template, [
            'form' => $form->createView(),
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * Login check action. This action should never be called.
     */
    public function checkAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall.');
    }

    /**
     * Logout action. This action should never be called.
     */
    public function logoutAction(Request $request): Response
    {
        throw new \RuntimeException('You must configure the logout path to be handled by the firewall.');
    }
}
