<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\GoogleBundle\Entity\GoogleDriveFile;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class GoogleDriveFileGridController extends GridController
{

    public function watchAction(Request $request): Response
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $vars = $configuration->getVars();

        $slug = $request->get('slug', null);

        $entity = $this->get($repository)->$method($slug);

        if (!$entity) {
            throw $this->createNotFoundException('el archivo que busca no existe');
        }

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'small_text' => '',
                'entity' => $entity,
            ]
        );
    }

    public function qrAction(Request $request)
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $vars = $configuration->getVars();

        $qr = 'https://chart.googleapis.com/chart?cht=qr&chs=250x250&chl=' . $request->get('link', null) . '&chld=L|0';

        return $this->render(
            $template,
            [
                'qr' => $qr,
            ]
        );


//        $response = $this->render(
//            'BackendBundle:Google:qr.html.twig',
//            [
//                'qr' => $qr,
//            ]
//        );
//
//        $response->setSharedMaxAge(self::MAX_AGE_WEEK);
//        $response->headers->addCacheControlDirective('must-revalidate', true);
//        return $response;
    }

}
