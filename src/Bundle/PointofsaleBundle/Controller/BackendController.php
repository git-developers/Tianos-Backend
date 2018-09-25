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
use Bundle\ProfileBundle\Entity\Profile;

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
        $pdvEntity = $this->get($repository)->$method($id);

        //FORM
        $form = $this->createForm($formType, $entity, [
            'form_data' => [],
            'entity_manager' => $this->getDoctrine()->getManager(),
        ]);
        $form->handleRequest($request);

        if (!$pdvEntity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

            try {

                if ($form->isValid()) {

                    $user = $this->get('tianos.repository.user')->findOneByUsername($entity->getUserTagUsername());

                    $pdvEntity->addUser($user);
                    $this->persist($pdvEntity);

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
                'entity' => $pdvEntity,
                'vars' => $vars,
                'userTags' => $this->getUserTags(),
                'profiles' => $this->findProfilesBySlugs(),
                'form' => $form->createView(),
            ]
        );
    }

    private function getUserTags()
    {

        $userTags = [];
        $userTagsObj = $this->get('tianos.repository.user')->findAll();

        foreach ($userTagsObj as $key => $value) {
            $userTags[] = [
                'label' => $value->getNameBox(),
                'value' => $value->getUsername(),
            ];
        }

        return json_encode($userTags);
    }

    private function findProfilesBySlugs()
    {
        $objects = $this->get('tianos.repository.profile')->findProfilesBySlugs([
            Profile::EMPLOYEE_SLUG,
            Profile::ADMIN_SLUG,
        ]);

        $array = [];
        foreach ($objects as $object) {
            $array[$object->getId()] = '(' . $object->getId() . ') ' . $object->getName();
        }

        return $array;
    }

    public function removeUserAction(Request $request): Response
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

        //REPOSITORY
        $pdvId = $request->get('pdvId');
        $userId = $request->get('userId');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $entity = $this->get($repository)->$method($pdvId);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $user = $this->get('tianos.repository.user')->find($userId);

        $entity->removeUser($user);
        $this->persist($entity);

        return $this->json([
            'status' => self::STATUS_SUCCESS,
            'errors' => [],
            'entity' => $entity,
        ]);
    }

}
