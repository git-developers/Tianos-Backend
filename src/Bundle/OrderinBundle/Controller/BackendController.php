<?php

declare(strict_types=1);

namespace Bundle\OrderinBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;

class BackendController extends BaseController
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

//        $repositoryCenter = $configuration->getRepositoryServiceCenter();
//        $methodCenter = $configuration->getRepositoryMethodCenter();

        $template = $configuration->getTemplate('');

//        $box = $configuration->oneToManyBox();
//        $boxLeft = $configuration->oneToManyBoxLeft();
//        $boxRight = $configuration->oneToManyBoxRight();

        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();
        $box = $vars['box'];
        $boxLeft = $vars['box_left'];
        $boxCenter = $vars['box_center'];
        $boxRight = $vars['box_right'];

        //REPOSITORY LEFT
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft();
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft['serialize_group_name']);

        //REPOSITORY CENTER
//        $objectsCenter = $this->get($repositoryCenter)->$methodCenter();
//        $varsCenter = $configuration->getRepositoryVarsCenter();
//        $objectsCenter = $this->getSerializeDecode($objectsCenter, $varsCenter['serialize_group_name']);

        //CRUD
        $crud = $this->get('tianos.one_to_many');
        $modal = $crud->getModalMapper()->getDefaults();
        $formMapper = $crud->getFormMapper()->getDefaults();

        //GRID
        $gridService = $this->get('tianos.grid');
        $modal = $gridService->getModalMapper()->getDefaults($modal);
        $formMapper = $gridService->getFormMapper()->getDefaults();

        //DATATABLE
        $dataTable = $gridService->getDataTableMapper($grid)
            ->setRoute()
            ->setColumns()
            ->setOptions()
            ->setRowCallBack()
//            ->setData($objects)
            ->setTableOptions()
            ->setTableButton()
            ->setTableHeaderButton()
            ->setColumnsTargets()
            ->resetGridVariable()
        ;

//        echo "POLLO:: <pre>";
//        print_r($dataTable);
//        exit;


        return $this->render(
            $template,
            [
                'box' => $box,
                'vars' => $vars,
                'modal' => $modal,
                'boxLeft' => $boxLeft,
                'boxCenter' => $boxCenter,
                'boxRight' => $boxRight,
                'objectsLeft' => $objectsLeft,
//                'objectsCenter' => $objectsCenter,
                'formMapper' => $formMapper,
                'dataTable' => $dataTable,
            ]
        );

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxLeftSearchAction(Request $request): Response
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
        $boxLeft = $vars['box_left'];

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        //REPOSITORY LEFT
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($request->get('q'));
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft['serialize_group_name']);

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'objectsLeft' => $objectsLeft,
            ]
        );
    }


    public function boxLeftSelectItemAction(Request $request): Response
    {
        $id = $request->get('id');

        if (!$this->isXmlHttpRequest() || is_null($id)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

//        $boxLeftValue = $request->get('boxLeftValue');
//        $boxRightValues = $request->get('boxRightValues');

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $template = $configuration->getTemplate('');

//        $boxRight = $configuration->oneToManyBoxRight();

        $vars = $configuration->getVars();
        $boxCenter = $vars['box_center'];
        $boxCenter = json_decode(json_encode($boxCenter));

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($id);
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft['serialize_group_name']);


//        echo "POLLO:: <pre>";
//        print_r($boxCenter);
//        exit;


        return $this->render(
            $template,
            [
                'boxCenter' => $boxCenter,
                'objectsCenter' => isset($objectsLeft[$boxCenter->entity]) ? $objectsLeft[$boxCenter->entity] : [],
            ]
        );
    }














    /**
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {



//        echo "POLLO:: <pre>";
//        print_r($request);
//        exit;




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
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $entity = $configuration->getEntity();
        $entity = new $entity();

        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::STATUS_ERROR;

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
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function editAction(Request $request): Response
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
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $action = $configuration->getAction();
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();

        //REPOSITORY
        $id = $request->get('id');
        $entity = $this->get($repository)->$method($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $status = self::STATUS_ERROR;

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

            return $this->json([
                'id' => $id,
                'status' => $status,
                'errors' => $errors,
                'entity' => $entity,
            ]);
        }

        return $this->render(
            $template,
            [
                'id' => $id,
                'action' => $action,
                'form' => $form->createView(),
            ]
        );
    }


    /*
    public function deleteAction(Request $request): Response
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

        $errors = [];
        $status = self::STATUS_ERROR;
        $id = $request->get('id');

        if ($request->isMethod('DELETE')) {

            //REPOSITORY
            $repository = $configuration->getRepositoryService();
            $method = $configuration->getRepositoryMethod();
            $entity = $this->get($repository)->$method($id);

            try {
                if($entity){
                    $entity->setIsActive(false);
                    //$this->remove($entity);
                    $this->persist($entity);
                    $status = self::STATUS_SUCCESS;
                }
            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'id' => $id,
                'status' => $status,
                'errors' => $errors,
            ]);
        }

        return $this->render(
            $template,
            [
                'id' => $id,
                'action' => $action,
            ]
        );
    }

    public function viewAction(Request $request): Response
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

        //REPOSITORY
        $id = $request->get('id');
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $entity = $this->get($repository)->$method($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $template,
            [
                'action' => $action,
                'entity' => $entity,
            ]
        );
    }
    */

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
}
