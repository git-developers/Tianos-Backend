<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GoogleDriveListController extends GridController
{

    public function watchAction(Request $request, $slug): Response
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CoreBundle:Files')->findOneBySlug($slug);

        if(!$entity){
            throw $this->createNotFoundException('el archivo que busca no existe');
        }

        return $this->render(
            'BackendBundle:Files/Watch:index.html.twig',
            [
                'small_text' => '',
                'entity' => $entity,
            ]
        );
    }

}
