<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\GridBundle\Controller\GridController;
use Bundle\ResourceBundle\ResourceBundle;
use Component\Resource\Metadata\Metadata;

class MapController extends GridController
{

    public function indexAction(Request $request): Response
    {
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

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

        //REPOSITORY
        $objects = $this->get($repository)->$method();
        $objects = $this->getSerializeDecode($objects, $vars['serialize_group_name']);

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'objects' => $objects,
            ]
        );
    }

}
