<?php

declare(strict_types=1);

namespace Bundle\OneToManyBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class OneToManyController extends BaseController
{

    /**
     * @var MetadataInterface
     */
    protected $metadata;

    /**
     * @var RequestConfigurationFactoryInterface
     */
    protected $requestConfigurationFactory;


//    public function __construct(RequestConfigurationFactoryInterface $requestConfigurationFactory) {
//        $this->requestConfigurationFactory = $requestConfigurationFactory;
//    }

    /**
     * @param Request $request
     *
     * @return Response
     */
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
//        $repository = $configuration->getRepositoryService();

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();

        $template = $configuration->getTemplate('');

        $box = $configuration->oneToManyBox();
        $boxLeft = $configuration->oneToManyBoxLeft();
        $boxRight = $configuration->oneToManyBoxRight();
        $vars = $configuration->getVars();


        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $vars['serialize_group_name']);
        $objectsRight = $this->get($repositoryRight)->$methodRight();
        $objectsRight = $this->getSerializeDecode($objectsRight, $vars['serialize_group_name']);


        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $formMapper = $crud->getFormMapper()->getDefaults();

        return $this->render(
            $template,
            [
                'box' => $box,
                'vars' => $vars,
                'modal' => $modal,
                'boxLeft' => $boxLeft,
                'boxRight' => $boxRight,
                'objectsLeft' => $objectsLeft,
                'objectsRight' => $objectsRight,
                'formMapper' => $formMapper,
            ]
        );

//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
    }

    public function boxLeftSearchAction(Request $request)
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
        $boxLeft = $configuration->oneToManyBoxLeft();

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($request->get('q'));
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $vars['serialize_group_name']);

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'objectsLeft' => $objectsLeft,
            ]
        );
    }

    public function boxRightSearchAction(Request $request)
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
        $boxRight = $configuration->oneToManyBoxRight();

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsRight = $this->get($repositoryRight)->$methodRight($request->get('q'));
        $objectsRight = $this->getSerializeDecode($objectsRight, $vars['serialize_group_name']);

        return $this->render(
            $template,
            [
                'boxRight' => $boxRight,
                'objectsRight' => $objectsRight,
                'isAssigned' => true,
            ]
        );
    }

    public function boxRightSelectItemAction(Request $request): Response
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $boxLeftValue = $request->get('boxLeftValue');
        $boxRightValues = $request->get('boxRightValues');

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();
        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->deleteAllById($boxLeftValue);

//        foreach ($objectsLeft as $key => $objectLeft){
//
//        }


        echo "POLLO:: <pre>";
        print_r($objectsLeft);
        exit;





        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($boxLeftValue);

        foreach ($boxRightValues as $key => $boxRightValue){

            //REPOSITORY
            $objectsRight = $this->get($repositoryRight)->$methodRight($boxRightValue);
            
            $objectsLeft->addRole($objectsRight);
            $this->persist($objectsLeft);
        }






/*        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $template = $configuration->getTemplate('');
        $boxRight = $configuration->oneToManyBoxRight();

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsRight = $this->get($repositoryRight)->$methodRight($request->get('q'));
        $objectsRight = $this->getSerializeDecode($objectsRight, $vars['serialize_group_name']);

        return $this->render(
            $template,
            [
                'boxRight' => $boxRight,
                'objectsRight' => $objectsRight,
                'isAssigned' => true,
            ]
        );*/
    }


    public function infoAction(Request $request): Response
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
        $action = $configuration->getAction();

        return $this->render(
            $template,
            [
                'action' => $action,
            ]
        );
    }






//    /**
//     * @param Request $request
//     * @return Response
//     */
//    public function createAction(Request $request): Response
//    {
//        if (!$this->isXmlHttpRequest()) {
//            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
//        }
//
//        $parameters = [
//            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
//        ];
//        $applicationName = $this->container->getParameter('application_name');
//        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//
//        //CONFIGURATION
//        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
//        $action = $configuration->getAction();
//        $formType = $configuration->getFormType();
//        $vars = $configuration->getVars();
//        $entity = $configuration->getEntity();
//        $entity = new $entity();
//
//        $form = $this->createForm($formType, $entity, ['form_data' => []]);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//
//            $errors = [];
//            $entityJson = null;
//            $status = self::STATUS_ERROR;
//
//            try{
//
//                if ($form->isValid()) {
//                    $this->persist($entity);
//                    $entity = $this->getSerializeDecode($entity, $vars['serialize_group_name']);
//                    $status = self::STATUS_SUCCESS;
//                }else{
//                    foreach ($form->getErrors(true) as $key => $error) {
//                        if ($form->isRoot()) {
//                            $errors[] = $error->getMessage();
//                        } else {
//                            $errors[] = $error->getMessage();
//                        }
//                    }
//                }
//
//            }catch (\Exception $e){
//                $errors[] = $e->getMessage();
//            }
//
//            return $this->json([
//                'status' => $status,
//                'errors' => $errors,
//                'entity' => $entity,
//            ]);
//        }
//
//        return $this->render(
//            $template,
//            [
//                'action' => $action,
//                'form' => $form->createView(),
//            ]
//        );
//    }
//
//    /**
//     * @param Request $request
//     * @return Response
//     */
//    public function editAction(Request $request): Response
//    {
//        if (!$this->isXmlHttpRequest()) {
//            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
//        }
//
//        $parameters = [
//            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
//        ];
//        $applicationName = $this->container->getParameter('application_name');
//        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//
//        //CONFIGURATION
//        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $repository = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
//        $template = $configuration->getTemplate('');
//        $action = $configuration->getAction();
//        $formType = $configuration->getFormType();
//        $vars = $configuration->getVars();
//
//        //REPOSITORY
//        $id = $request->get('id');
//        $entity = $this->get($repository)->$method($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
//        }
//
//        $form = $this->createForm($formType, $entity, ['form_data' => []]);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted()) {
//
//            $errors = [];
//            $status = self::STATUS_ERROR;
//
//            try{
//
//                if ($form->isValid()) {
//                    $this->persist($entity);
//                    $entity = $this->getSerializeDecode($entity, $vars['serialize_group_name']);
//                    $status = self::STATUS_SUCCESS;
//                }else{
//                    foreach ($form->getErrors(true) as $key => $error) {
//                        if ($form->isRoot()) {
//                            $errors[] = $error->getMessage();
//                        } else {
//                            $errors[] = $error->getMessage();
//                        }
//                    }
//                }
//
//            }catch (\Exception $e){
//                $errors[] = $e->getMessage();
//            }
//
//            return $this->json([
//                'id' => $id,
//                'status' => $status,
//                'errors' => $errors,
//                'entity' => $entity,
//            ]);
//        }
//
//        return $this->render(
//            $template,
//            [
//                'id' => $id,
//                'action' => $action,
//                'form' => $form->createView(),
//            ]
//        );
//    }
//
//    /**
//     * @param Request $request
//     * @return Response
//     */
//    public function deleteAction(Request $request): Response
//    {
//        if (!$this->isXmlHttpRequest()) {
//            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
//        }
//
//        $parameters = [
//            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
//        ];
//        $applicationName = $this->container->getParameter('application_name');
//        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//
//        //CONFIGURATION
//        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
//        $action = $configuration->getAction();
//
//        $errors = [];
//        $status = self::STATUS_ERROR;
//        $id = $request->get('id');
//
//        if ($request->isMethod('DELETE')) {
//
//            //REPOSITORY
//            $repository = $configuration->getRepositoryService();
//            $method = $configuration->getRepositoryMethod();
//            $entity = $this->get($repository)->$method($id);
//
//            try {
//                if($entity){
//                    $entity->setIsActive(false);
//                    //$this->remove($entity);
//                    $this->persist($entity);
//                    $status = self::STATUS_SUCCESS;
//                }
//            }catch (\Exception $e){
//                $errors[] = $e->getMessage();
//            }
//
//            return $this->json([
//                'id' => $id,
//                'status' => $status,
//                'errors' => $errors,
//            ]);
//        }
//
//        return $this->render(
//            $template,
//            [
//                'id' => $id,
//                'action' => $action,
//            ]
//        );
//    }
//
//    public function viewAction(Request $request): Response
//    {
//        if (!$this->isXmlHttpRequest()) {
//            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
//        }
//
//        $parameters = [
//            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
//        ];
//        $applicationName = $this->container->getParameter('application_name');
//        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//
//        //CONFIGURATION
//        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
//        $action = $configuration->getAction();
//
//        //REPOSITORY
//        $id = $request->get('id');
//        $repository = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
//        $entity = $this->get($repository)->$method($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
//        }
//
//        return $this->render(
//            $template,
//            [
//                'action' => $action,
//                'entity' => $entity,
//            ]
//        );
//    }







}

