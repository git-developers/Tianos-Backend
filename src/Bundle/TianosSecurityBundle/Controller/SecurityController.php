<?php

declare(strict_types=1);

namespace Bundle\TianosSecurityBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Controller\BaseController;

//use CoreBundle\Entity\User;
//use CoreBundle\Entity\Profile;
//use FrontendBundle\Form\UserRegisterType;

class SecurityController extends BaseController
{

    public function loginAction(Request $request): Response
    {

        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirect($this->generateUrl('backend_default_index'));
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $response = $this->render(
            'FrontendBundle:Security:login.html.twig',
            [
                'last_username' => $lastUsername,// last username entered by the user
                'error' => $error,
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

    /*
    public function registerAction(Request $request): Response
    {

        if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            return $this->redirect($this->generateUrl('backend_default_index'));
        }

        $entity = new User();
        $form = $this->createForm(UserRegisterType::class, $entity, ['attr' => ['class' => '']]);
        $form->handleRequest($request);

        $validator = $this->container->get('validator');
        $validator->validate($entity, null, ['registration']);

        $profile = $this->em()->getRepository(Profile::class)->findOneBySlug(Profile::GUEST);
        $entity->setProfile($profile);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->persist($entity);
            $this->flashSuccess('Cuenta creada, puedes iniciar sesión.');

            return $this->redirectToRoute('frontend_security_login');
        }

        $response = $this->render(
            'FrontendBundle:Security:register.html.twig',
            [
                'formEntity' => $form->createView(),
            ]
        );

        $response->setSharedMaxAge(self::MAX_AGE_YEAR);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }
    */

}
