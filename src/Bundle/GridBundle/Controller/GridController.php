<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\GridBundle\Services\Crud\Builder\DataTableMapper;

class GridController extends BaseController
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
        $service = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();

        //REPOSITORY
        $repository = $this->get($service);
        $objects = $repository->$method();
        $objects = $this->getSerialize($objects, 'product');

        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $form = $crud->getFormMapper()->getDefaults();

        //DATATABLE
        $dataTable = $crud->getDataTableMapper($grid)
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


//        echo '<pre> POLLO --- $grid:: ';
//        print_r($request);
//        exit;


        return $this->render(
            $template,
            [
                'vars' => $vars,
                'grid' => $grid,
                'form' => $form,
                'modal' => $modal,
                'dataTable' => $dataTable,
            ]
        );

//        $name = $request->query->get('name');
//
//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
    }

    public function infoAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $service = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
//        $grid = $configuration->getGrid();
//        $vars = $configuration->getVars();
        $action = $configuration->getAction();

        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();


        return $this->render(
            $template,
            [
//                'vars' => $vars,
//                'grid' => $grid,
                'action' => $action,
//                'form' => $form,
//                'modal' => $modal,
//                'dataTable' => $dataTable,
            ]
        );





/*        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $crudMapper
            ->add('template_info', $crudMapper->getInfoTemplate())
        ;

        $crud = $crudMapper->getDefaults();

        return $this->render(
            $this->validateTemplate($crud['template_info']),
            [
                'xxx' => '',
            ]
        );*/
    }



    public function createAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $service = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
//        $grid = $configuration->getGrid();
//        $vars = $configuration->getVars();
        $action = $configuration->getAction();


        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $form = $crud->getFormMapper()->getDefaults();

        return $this->render(
            $template,
            [
                'modal' => $modal,
                'form' => $form,
                'action' => $action,
//                'vars' => $vars,
//                'grid' => $grid,
            ]
        );
    }


    public function editAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $service = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
//        $grid = $configuration->getGrid();
//        $vars = $configuration->getVars();
        $action = $configuration->getAction();


        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $form = $crud->getFormMapper()->getDefaults();

        return $this->render(
            $template,
            [
                'modal' => $modal,
                'form' => $form,
                'action' => $action,
//                'vars' => $vars,
//                'grid' => $grid,
            ]
        );
    }



    public function deleteAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $service = $configuration->getRepositoryService();
//        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');
//        $grid = $configuration->getGrid();
//        $vars = $configuration->getVars();
        $action = $configuration->getAction();


        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $form = $crud->getFormMapper()->getDefaults();

        return $this->render(
            $template,
            [
                'modal' => $modal,
                'form' => $form,
                'action' => $action,
//                'vars' => $vars,
//                'grid' => $grid,
            ]
        );
    }



}


/*
Sylius\Component\Resource\Metadata\Metadata Object
(
[name:Sylius\Component\Resource\Metadata\Metadata:private] => product
[applicationName:Sylius\Component\Resource\Metadata\Metadata:private] => sylius
[driver:Sylius\Component\Resource\Metadata\Metadata:private] => doctrine/orm
[templatesNamespace:Sylius\Component\Resource\Metadata\Metadata:private] =>
[parameters:Sylius\Component\Resource\Metadata\Metadata:private] => Array
(
    [driver] => doctrine/orm
    [classes] => Array
        (
            [model] => Sylius\Component\Core\Model\Product
            [repository] => Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository
            [interface] => Sylius\Component\Product\Model\ProductInterface
            [controller] => Sylius\Bundle\ResourceBundle\Controller\ResourceController
            [factory] => Sylius\Component\Resource\Factory\TranslatableFactory
            [form] => Sylius\Bundle\ProductBundle\Form\Type\ProductType
        )

    [translation] => Array
        (
            [classes] => Array
                (
                    [model] => Sylius\Component\Core\Model\ProductTranslation
                    [interface] => Sylius\Component\Product\Model\ProductTranslationInterface
                    [controller] => Sylius\Bundle\ResourceBundle\Controller\ResourceController
                    [factory] => Sylius\Component\Resource\Factory\Factory
                    [form] => Sylius\Bundle\ProductBundle\Form\Type\ProductTranslationType
                )

        )

)

)
 */
