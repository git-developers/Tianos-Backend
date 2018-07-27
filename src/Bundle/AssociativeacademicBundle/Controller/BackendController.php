<?php

declare(strict_types=1);

namespace Bundle\AssociativeacademicBundle\Controller;

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

//        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();
        $box = $vars->box;
        $boxOne = $vars->box_one;
        $boxTwo = $vars->box_two;
        $boxThree = $vars->box_three;
        $boxFour = $vars->box_four;

        //REPOSITORY LEFT
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft();

//        if($this->isGranted(['ROLE_' . Profile::DISTRIBUIDOR,])) {
//            $objectsLeft = $this->getUser()->getPointOfSale();
//        }

        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);
        //REPOSITORY LEFT

        //CRUD
        $crud = $this->get('tianos.one_to_many');
        $modal = $crud->getModalMapper()->getDefaults();
        $formMapper = $crud->getFormMapper()->getDefaults();

        //GRID
        $gridService = $this->get('tianos.grid');
        $modal = $gridService->getModalMapper()->getDefaults($modal);
        $formMapper = $gridService->getFormMapper()->getDefaults();

        //DATATABLE
//        $dataTable = $gridService->getDataTableMapper($grid)
//            ->setRoute()
//            ->setColumns()
//            ->setOptions()
//            ->setRowCallBack()
////            ->setData($objects)
//            ->setTableOptions()
//            ->setTableButton()
//            ->setTableHeaderButton()
//            ->setColumnsTargets()
//            ->resetGridVariable()
        ;

        return $this->render(
            $template,
            [
                'box' => $box,
                'vars' => $vars,
                'modal' => $modal,
                'boxOne' => $boxOne,
                'boxTwo' => $boxTwo,
                'boxThree' => $boxThree,
                'boxFour' => $boxFour,
                'objectsLeft' => $objectsLeft,
                'formMapper' => $formMapper,
//                'dataTable' => $dataTable,
            ]
        );
    }

}
