<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends BaseController
{

//    public function __construct() {
////        parent::__construct($requestConfigurationFactory);
//    }


    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
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
            throw $this->createNotFoundException('El usuario que busca no existe');
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


}
