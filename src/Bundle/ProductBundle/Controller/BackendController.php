<?php

declare(strict_types=1);

namespace Bundle\ProductBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class BackendController extends GridController
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
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();
        $tree = $configuration->getTree();
        $modal = $configuration->getModal();

        //REPOSITORY
        $categoryId = $request->get('categoryId');
        $objects = $this->get($repository)->$method($categoryId);
        $varsRepository = $configuration->getRepositoryVars();
        $objects = $this->getSerialize($objects, $varsRepository->serialize_group_name);

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
            ->setData($objects)
            ->setTableOptions()
            ->setTableButton()
            ->setTableHeaderButton()
            ->setColumnsTargets()
            ->resetGridVariable()
        ;

        //REPOSITORY TREE
        $objectsTree = $this->get('tianos.repository.category')->findAllParentsByType($varsRepository->entity_type);
        $objectsTree = $this->getTreeEntities($objectsTree, $configuration, 'tree');

        return $this->render(
            $template,
            [
                'vars' => $vars,
                'tree' => $tree,
                'grid' => $grid,
                'modal' => $modal,
                'objectsTree' => $objectsTree,
                'dataTable' => $dataTable,
                'form_mapper' => $formMapper,
                'categoryId' => $categoryId,
            ]
        );
    }

    private function getTreeEntities($parents, $configuration, $serializeGroupName)
    {
        if(is_null($parents)){
            $parents = [];
        }

        $entity = [];
        foreach ($parents as $key => $parent){
            $entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
            $children = $this->get('tianos.repository.category')->findAllByParent($parent);
            $entity[$key]['children'] = $this->getTreeEntities($children, $configuration, $serializeGroupName);
        }

        return $entity;
    }

}
