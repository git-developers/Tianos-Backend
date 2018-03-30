<?php

declare(strict_types=1);

namespace Bundle\VisitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;

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
        $entity = new $entity();





        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        $errors = [];

//        if ($form->isSubmitted()) {

        $entityJson = null;
        $status = self::STATUS_ERROR;





        //jafeth
        $data = $request->get('visit');

        if(isset($data['visitStart'])){
            $entity->setVisitStart(new \DateTime($data['visitStart']));
        }

        if(isset($data['visitEnd'])){
            $entity->setVisitEnd(new \DateTime($data['visitEnd']));
        }
        //jafeth

        $this->persist($entity);
        $entity = $this->getSerializeDecode($entity, $vars['serialize_group_name']);
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
            'entity' => $entity,
        ]);

    }

}
