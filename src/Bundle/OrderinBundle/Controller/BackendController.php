<?php

declare(strict_types=1);

namespace Bundle\OrderinBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\OrderinBundle\Entity\Order;

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

    /**
     * @param Request $request
     * @return Response
     */
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

    public function boxCenterSelectItemAction(Request $request): Response
    {

        $pointOfSaleId = $request->get('pointOfSaleId');
        $userId = $request->get('userId');

        if (!$this->isXmlHttpRequest() || is_null($userId) || is_null($pointOfSaleId)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);

        $repositoryRight = $configuration->getRepositoryServiceRight();
        $methodRight = $configuration->getRepositoryMethodRight();
        $template = $configuration->getTemplate('');

//        $boxRight = $configuration->oneToManyBoxRight();

        $vars = $configuration->getVars();
        $boxRight = $vars['box_right'];
        $boxRight = json_decode(json_encode($boxRight));

        //REPOSITORY
        $objectsRight = $this->get($repositoryRight)->$methodRight();
        $varsRight = $configuration->getRepositoryVarsRight();
        $objectsRight = $this->getSerializeDecode($objectsRight, $varsRight['serialize_group_name']);

        //ORDERS
        $datetime = new \DateTime("now");
        $orderDate = $datetime->format('Y-m-d');
        $orders = $this->get('tianos.repository.orderin')->findObjectCenterSelectItem(
            $pointOfSaleId,
            $userId,
            $orderDate
        );

//        foreach ($orders as $key => $order) {
//            echo "POLLO:: <pre>";
//            print_r($order->getProduct()->getId());
//        }
//
//
//        exit;


        return $this->render(
            $template,
            [
                'orders' => $orders,
                'boxRight' => $boxRight,
                'objectsRight' => $objectsRight,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function upsertAction(Request $request): Response
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
        $formType = $configuration->getFormType();
        $vars = $configuration->getVars();
        $entity = $configuration->getEntity();

//        $form = $this->createForm($formType, $entity, ['form_data' => []]);
//        $form->handleRequest($request);

        $all = $request->request->all();
        $all = json_decode(json_encode($all));

        $pointOfSaleId = $all->box_left_selected_value;
        $userId = $all->box_center_selected_value;
        $orderDate = $all->order_date;
        $products = $all->order->product;
        $quantities = $all->order->quantity;

        $pointOfSale = $this->get('tianos.repository.pointofsale')->find($pointOfSaleId);
        $user = $this->get('tianos.repository.user')->find($userId);

        foreach ($quantities as $key => $quantity) {

            $productId = isset($products[$key]) ? $products[$key] : 0;

            if ( (int)$quantity <= 0 || (int)$productId <= 0 ) {
                continue;
            }

            $order = $this->get('tianos.repository.orderin')->findObjectUpsert(
                $pointOfSaleId,
                $userId,
                $orderDate,
                $productId
            );

            if (is_null($order)) {
                $order = new $entity();
                $order->setPointOfSale($pointOfSale);
                $order->setUser($user);
                $order->setOrderDate(new \DateTime($orderDate));
                $order->setType(Order::IN);

                $product = $this->get('tianos.repository.product')->find($productId);
                $order->setProduct($product);
            }

            $order->setQuantity($quantity);
            $this->persist($order);
        }

        return $this->json([
            'status' => true,
            'errors' => [],
        ]);
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
}
