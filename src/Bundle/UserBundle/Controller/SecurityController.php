<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\UserBundle\Form\Type\UserLoginType;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;
use Bundle\UserBundle\Entity\User;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\UserBundle\Form\Type\UserRegisterType;

class SecurityController extends BaseController
{
    /**
     * Login form action.
     */
    public function loginAction(Request $request): Response
    {
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
     * @param Request $request
     * @return Response
     */
    public function registerAction(Request $request): Response
    {

//        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
//        {
//            return $this->redirect($this->generateUrl('backend_default_index'));
//        }

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        $entity = new User();
        $form = $this->createForm(UserRegisterType::class, $entity, ['attr' => ['class' => '']]);
        $form->handleRequest($request);

        $validator = $this->container->get('validator');
        $validator->validate($entity, null, ['registration']);

        $profile = $this->get('tianos.repository.profile')->findOneBySlug(Profile::REGULAR_USER);
        $entity->setProfile($profile);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persist($entity);

//            $entity->setImage('https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png');

            $this->flashSuccess('Cuenta creada, puedes iniciar sesión.');

            return $this->redirectToRoute('backend_security_login');
        }

        return $this->render($template, [
            'form' => $form->createView(),
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
