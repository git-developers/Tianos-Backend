<?php

declare(strict_types=1);

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class BackendSettingController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];

        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $vars = $configuration->getVars();
        $boxLeft = $vars->box_left;
        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        //REPOSITORY LEFT
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($request->get('q'));
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'objectsLeft' => $objectsLeft,
            ]
        );
    }
}
