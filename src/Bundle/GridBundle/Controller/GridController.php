<?php

declare(strict_types=1);

namespace Bundle\GridBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\ProductBundle\Entity\Product;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class GridController extends Controller
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
//        $this->metadata = new Metadata('product', $applicationName, $parameters);

        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $service = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

        $repository = $this->get($service);
        $objects = $repository->$method();


        $objects = $this->getSerialize($objects, 'product');

        echo '<pre> POLLO 555555 :: ';
        print_r($objects);
        exit;




//        $entity = $this->em()->getRepository($crud['class_path'])->findAll();
//        $entity = $this->getSerialize($entity, $crud['group_name']);
//        $dataTable->setData($entity);

        return $this->render(
            'CoreBundle:Crud:index.html.twig',
            [
//                'crud' => $crud,
//                'dataTable' => $dataTable,
            ]
        );



//        $name = $request->query->get('name');
//
//        return new JsonResponse([
//            'slug' => $this->get('sylius.generator.slug')->generate($name),
//        ]);
    }

    protected function getSerialize($object, $groupName)
    {
        $serializer = $this->get('jms_serializer');

        return $serializer->serialize(
            $object,
            'json',
            SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
        );
    }


}


//        $tianos = $request->get('_tianos');
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
//        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);


//        echo 8888;
//        exit;


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
