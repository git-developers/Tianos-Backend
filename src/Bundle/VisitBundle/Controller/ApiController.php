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

    public function createAction(Request $request): Response
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



        $saveEntity = [];
        $visits = $request->get('visits');

        foreach ($visits as $key => $visit){

            //$visitObject = $this->em()->getRepository(Visit::class)->findByUuid($visit['uuid']);
            $visitObject = $this->get('tianos.repository.visit')->findByUuid($visit['uuid']);


            if(is_null($visitObject)){
                $visitObject = new $entity();
            }


//            $form = $this->createForm($formType, $entity, ['form_data' => []]);
//            $form->handleRequest($request);

            $errors = [];

//        if ($form->isSubmitted()) {


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

            if(isset($visit['visitStart'])){
                $visitObject->setVisitStart(new \DateTime($visit['visitStart']));
            }

            if(isset($visit['visitEnd'])){
                $visitObject->setVisitEnd(new \DateTime($visit['visitEnd']));
            }

            $this->persist($visitObject);
            $saveEntity[] = $this->getSerializeDecode($visitObject, $vars['serialize_group_name']);
        }


        $status = self::STATUS_SUCCESS;






        /*
        try{

            if ($form->isValid()) {

                $this->persist($entity);
                $entity = $this->getSerializeDecode($entity, $vars['serialize_group_name']);
                $status = self::STATUS_SUCCESS;
            }else{
                foreach ($form->getErrors(true) as $key => $error) {
                    if ($form->isRoot()) {
                        $errors[] = $error->getMessage();
                    } else {
                        $errors[] = $error->getMessage();
                    }
                }
            }

        }catch (\Exception $e){
            $errors[] = $e->getMessage();
        }
        */

        return $this->json([
            'status' => $status,
            'errors' => $errors,
            'entity' => $saveEntity,
        ]);

    }

}
