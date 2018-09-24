<?php

declare(strict_types=1);

namespace Bundle\PointofsaleBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class BackendController extends GridController
{

    public function addUserAction(Request $request): Response
    {

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $vars = $configuration->getVars();
        $formType = $configuration->getFormType();
        $entity = $configuration->getEntity();
        $entity = new $entity();

        //REPOSITORY
        $id = $request->get('id');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $entityObj = $this->get($repository)->$method($id);

        //FORM
        $form = $this->createForm($formType, $entity, [
            'form_data' => [],
            'entity_manager' => $this->getDoctrine()->getManager(),
        ]);
        $form->handleRequest($request);

        if (!$entityObj) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $userTags = [];
        $userTagsObj = $this->get('tianos.repository.user')->findAll();

        foreach ($userTagsObj as $key => $value) {
            $userTags[] = [
                'label' => $value->getNameBox(),
                'value' => $value->getUsername(),
//                'desc' => 'creado: ' . $value->getCreatedAt()->format("Y-m-d H:i:s"),
            ];
        }

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try {

                if ($form->isValid()) {

                    $this->persist($entity);

                    $varsRepository = $configuration->getRepositoryVars();
                    $entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
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

            } catch (\Exception $e) {
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
                'entity' => $entity,
            ]);
        }

        return $this->render(
            $template,
            [
                'action' => $action,
                'entity' => $entityObj,
                'vars' => $vars,
                'userTags' => json_encode($userTags),
                'form' => $form->createView(),
            ]
        );
    }

}
