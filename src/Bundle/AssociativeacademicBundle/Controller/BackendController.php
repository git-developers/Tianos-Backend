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
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $template = $configuration->getTemplate('');

//        $grid = $configuration->getGrid();
        $vars = $configuration->getVars();
        $box = $vars->box;
        $boxOne = $vars->box_one;
        $boxTwo = $vars->box_two;
        $boxThree = $vars->box_three;
        $boxFour = $vars->box_four;


        //REPOSITORY ONE
        $varsRepo = $configuration->getRepositoryVars();
        $objectsOne = $this->get($repository)->$method();
        $objectsOne = $this->getSerializeDecode($objectsOne, $varsRepo->serialize_group_name);


        //CRUD
        $crud = $this->get('tianos.one_to_many');
        $modal = $crud->getModalMapper()->getDefaults();
//        $formMapper = $crud->getFormMapper()->getDefaults();

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
                'objectsOne' => $objectsOne,
//                'formMapper' => $formMapper,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxOneSearchAction(Request $request): Response
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
        $boxOne = $vars->box_one;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($request->get('q'));
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxOne' => $boxOne,
                'objectsOne' => $objects,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxTwoSearchAction(Request $request): Response
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
        $boxTwo = $vars->box_two;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($request->get('q'));
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxTwo' => $boxTwo,
                'objectsTwo' => $objects,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxThreeSearchAction(Request $request): Response
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
        $boxThree = $vars->box_three;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($request->get('q'));
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxThree' => $boxThree,
                'objectsThree' => $objects,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxFourSearchAction(Request $request): Response
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
        $boxFour = $vars->box_four;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($request->get('q'));
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxFour' => $boxFour,
                'objectsFour' => $objects,
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxOneSelectItemAction(Request $request): Response
    {
        $boxOneId = $request->get('boxOneId');

        if (!$this->isXmlHttpRequest() || is_null($boxOneId)) {
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
        $boxTwo = $vars->box_two;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($boxOneId);
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxOneId' => $boxOneId,
                'boxTwo' => $boxTwo,
                'objectsTwo' => isset($objects[$boxTwo->entity]) ? $objects[$boxTwo->entity] : [],
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxTwoSelectItemAction(Request $request): Response
    {
        $boxTwoId = $request->get('boxTwoId');

        if (!$this->isXmlHttpRequest() || is_null($boxTwoId)) {
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
        $boxThree = $vars->box_three;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($boxTwoId);
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxThree' => $boxThree,
                'objectsThree' => isset($objects[$boxThree->entity]) ? $objects[$boxThree->entity] : [],
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxTwoUpSertingAction(Request $request): Response
    {
        $boxOneId = $request->get('boxOneId');
        $boxTwoId = $request->get('boxTwoId');
        $isChecked = $request->get('isChecked');

        if (!$this->isXmlHttpRequest() || is_null($boxOneId) || is_null($boxTwoId)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
//        $vars = $configuration->getVars();
//        $boxThree = $vars->box_three;

        //REPOSITORY
        $repositoryOne = $configuration->getRepositoryServiceOne();
        $methodOne = $configuration->getRepositoryMethodOne();
        $repositoryTwo = $configuration->getRepositoryServiceTwo();
        $methodTwo = $configuration->getRepositoryMethodTwo();
//        $vars = $configuration->getRepositoryVarsOne();

        $objectOne = $this->get($repositoryOne)->$methodOne($boxOneId, $boxTwoId);
        $objectTwo = $this->get($repositoryTwo)->$methodTwo($boxTwoId);

        if (is_null($objectOne) && $isChecked) {
            $objectOne = $this->get($repositoryOne)->find($boxOneId);
            $objectOne->addAreaacademica($objectTwo);
            $this->persist($objectOne);
        } else {
            $objectOne->removeAreaacademica($objectTwo);
            $this->persist($objectOne);
        }

        return $this->json(
            [
                'status' => true
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxThreeSelectItemAction(Request $request): Response
    {
        $boxThreeId = $request->get('boxThreeId');

        if (!$this->isXmlHttpRequest() || is_null($boxThreeId)) {
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
        $boxFour = $vars->box_four;

        //REPOSITORY
        $repository = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();
        $vars = $configuration->getRepositoryVars();

        $objects = $this->get($repository)->$method($boxThreeId);
        $objects = $this->getSerializeDecode($objects, $vars->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxFour' => $boxFour,
                'objectsFour' => isset($objects[$boxFour->entity]) ? $objects[$boxFour->entity] : [],
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function boxThreeUpSertingAction(Request $request): Response
    {
        $boxTwoId = $request->get('boxTwoId');
        $boxThreeId = $request->get('boxThreeId');
        $isChecked = $request->get('isChecked');

        if (!$this->isXmlHttpRequest() || is_null($boxTwoId) || is_null($boxThreeId)) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);

        //CONFIGURATION
        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
//        $template = $configuration->getTemplate('');
//        $vars = $configuration->getVars();
//        $boxThree = $vars->box_three;

        //REPOSITORY
        $repositoryTwo = $configuration->getRepositoryServiceTwo();
        $methodTwo = $configuration->getRepositoryMethodTwo();
        $repositoryThree = $configuration->getRepositoryServiceThree();
        $methodThree = $configuration->getRepositoryMethodThree();

        $objectOne = $this->get($repositoryTwo)->$methodTwo($boxTwoId, $boxThreeId);
        $objectTwo = $this->get($repositoryThree)->$methodThree($boxThreeId);

        if ((bool) is_null($objectOne) && $isChecked) {




            $objectOne = $this->get($repositoryTwo)->find($boxTwoId);
            $objectOne->addFacultad($objectTwo);
            $this->persist($objectOne);
        } else {
            $objectOne->removeFacultad($objectTwo);
            $this->persist($objectOne);
        }

        return $this->json(
            [
                'status' => true
            ]
        );
    }

}
