<?php

declare(strict_types=1);

namespace Bundle\VisitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Bundle\VisitBundle\Entity\Visit;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\UserBundle\Entity\User;

class ApiController extends BaseController
{

    public function startAction(Request $request): Response
    {

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $entity = $configuration->getEntity();


//            $form = $this->createForm($formType, $entity, ['form_data' => []]);
//            $form->handleRequest($request);
//        if ($form->isSubmitted()) {

        $saveEntity = [];
        $visits = $request->get('visits');

        foreach ($visits as $key => $visit){

            $visitObject = $this->get('tianos.repository.visit')->findOneByUuid($visit['uuid']);

            if(is_null($visitObject)){
                $visitObject = new $entity();
            }

            if(isset($visit['uuid'])){
                $visitObject->setUuid($visit['uuid']);
            }

            if(isset($visit['username'])){
                $user = $this->em()->getRepository(User::class)->findOneByUsername($visit['username']);
                $visitObject->setUser($user);
            }

            if(isset($visit['pointOfSale'])){
                $pdv = $this->em()->getRepository(Pointofsale::class)->find($visit['pointOfSale']);
                $visitObject->setPointOfSale($pdv);
            }

            if( isset($visit['visitStart']) && !empty($visit['visitStart']) ){
                $visitObject->setVisitStart(new \DateTime($visit['visitStart']));
            }

//            if( isset($visit['visitEnd']) && !empty($visit['visitEnd']) ){
//                $visitObject->setVisitEnd(new \DateTime($visit['visitEnd']));
//            }

            $this->persist($visitObject);
//            $saveEntity[] = $this->getSerializeDecode($visitObject, $vars['serialize_group_name']);
            $saveEntity[]['uuid'] = $visit['uuid'];
            $saveEntity[]['id_backend'] = $visitObject->getId();
        }

        $status = self::STATUS_SUCCESS;

        return $this->json([
//            'status' => $status,
//            'errors' => [],
            'visits' => $saveEntity,
        ]);

    }

    public function endAction(Request $request): Response
    {

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $entity = $configuration->getEntity();


//            $form = $this->createForm($formType, $entity, ['form_data' => []]);
//            $form->handleRequest($request);
//        if ($form->isSubmitted()) {


        $saveEntity = [];
        $visits = $request->get('visits');

        foreach ($visits as $key => $visit){

            $visitObject = $this->get('tianos.repository.visit')->findOneByUuid($visit['uuid']);

            if( isset($visit['visitEnd']) && !empty($visit['visitEnd']) ){
                $visitObject->setVisitEnd(new \DateTime($visit['visitEnd']));
            }

            $this->persist($visitObject);
            $saveEntity[]['uuid'] = $visit['uuid'];
            $saveEntity[]['id_backend'] = $visitObject->getId();
//            $saveEntity[] = $this->getSerializeDecode($visitObject, $vars['serialize_group_name']);
        }


        $status = self::STATUS_SUCCESS;

        return $this->json([
//            'status' => $status,
//            'errors' => [],
            'visits' => $saveEntity,
        ]);
    }

}
