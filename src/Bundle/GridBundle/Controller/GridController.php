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

        //REPOSITORY
        $repository = $this->get($service);
        $objects = $repository->$method();
        $objects = $this->getSerialize($objects, 'product');

        //CRUD
        $crud = $this->get('grid.crud');
        $modal = $crud->getModalMapper()->getDefaults();
        $form = $crud->getFormMapper()->getDefaults();
        $buttonHeader = $crud->getButtonHeaderMapper($grid)->getDefaults();

        //DATATABLE
        $dataTable = $crud->getDataTableMapper($grid)
                        ->setOptions()
                        ->setTableOptions()
                        ->setColumns($grid)
                        ->setColumnsTargets()
                        ->setData($objects)
        ;


//        echo '<pre> POLLO --- 666 ---- $dataTable:: ';
//        print_r($dataTable);
//        exit;





//                ->buildColumn($grid)

//            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
////            ->addColumn('category', 'obj.category', [
////                'property' => 'obj.category.name',
////                'icon' => 'sitemap',
////            ])
//            ->addColumn('code', 'obj.code', [
//                'icon' => 'map-marker'
//            ])
//            ->addColumn('Name', 'obj.name')
//            ->addColumn('Slug', 'obj.slug')
//            ->addColumn('Creado', 'obj.created_at', [
//                'icon' => 'calendar'
//            ])
//            ->addButtonTable(['edit', 'delete'], 'obj.id_increment')
//            ->addRowCallBack('id', 'aData.id_increment')
//            ->addRowCallBack('data-id', 'aData.id_increment')
//            ->addRowCallBack('class', ' "alert" ')
            ;

        return $this->render(
            $template,
            [
                'grid' => $grid,
                'form' => $form,
                'modal' => $modal,
                'objects' => $objects,
                'dataTable' => $dataTable,
                'buttonHeader' => $buttonHeader,
            ]
        );



//        $name = $request->query->get('name');
//
//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
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
