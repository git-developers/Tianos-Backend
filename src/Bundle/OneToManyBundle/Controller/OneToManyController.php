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
        $methodDeleteAssociativeLeft = $configuration->getRepositoryMethodDeleteAssociativeLeft();
        $vars = $configuration->getVars();

        //DELETE
        $result = $this->get($repositoryLeft)->$methodDeleteAssociativeLeft($boxLeftValue);

        if(!$result){
            return $this->json([
                'status' => false,
                'response' => [
                    'msg' => '',
                ],
            ]);
        }

        //SAVE
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($boxLeftValue);
        foreach ($boxRightValues as $key => $boxRightValue){
            $objectsRight = $this->get($repositoryRight)->$methodRight($boxRightValue);
            $objectsLeft->addRole($objectsRight);
            $this->persist($objectsLeft);
        }

        return $this->json([
            'status' => true,
            'response' => [
                'msg' => '',
            ],
        ]);
    }

    public function boxLeftSelectItemAction(Request $request): Response
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

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();
        $vars = $configuration->getVars();

        //REPOSITORY
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $vars['serialize_group_name']);

/*        //DELETE
        $result = $this->get($repositoryLeft)->$methodDeleteAssociativeLeft($boxLeftValue);

        if(!$result){
            return $this->json([
                'status' => false,
                'response' => [
                    'msg' => '',
                ],
            ]);
        }

        //SAVE
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($boxLeftValue);
        foreach ($boxRightValues as $key => $boxRightValue){
            $objectsRight = $this->get($repositoryRight)->$methodRight($boxRightValue);
            $objectsLeft->addRole($objectsRight);
            $this->persist($objectsLeft);
        }*/

        return $this->json([
            'objectsLeft' => $objectsLeft,
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

