<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\GoogleBundle\Entity\GoogleDriveFileVote;

class GoogleDriveFileVoteController extends BaseController
{

    public function voteAction(Request $request): Response
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

        $fileId = $request->get('fileId', null);
        $vote = $request->get('vote', null);


        echo "POLLO:: <pre>";
        print_r($vote);
        exit;




//        $entity = $this->get($repository)->$method($slug);
//
//
//        if(!$entity){
//            throw $this->createNotFoundException('el archivo que busca no existe');
//        }

        return $this->json(
            [
                'status' => true
            ]
        );
    }

}
