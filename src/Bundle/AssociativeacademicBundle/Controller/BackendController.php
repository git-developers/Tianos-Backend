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
        $objectsOne = $this->get($repositoryLeft)->$methodLeft();
        $objectsOne = $this->getSerializeDecode($objectsOne, $varsLeft->serialize_group_name);
        //REPOSITORY LEFT


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
        $boxLeft = $vars->box_left;

        $repositoryLeft = $configuration->getRepositoryServiceLeft();
        $methodLeft = $configuration->getRepositoryMethodLeft();

        //REPOSITORY LEFT
        $objectsLeft = $this->get($repositoryLeft)->$methodLeft($request->get('q'));
        $varsLeft = $configuration->getRepositoryVarsLeft();
        $objectsLeft = $this->getSerializeDecode($objectsLeft, $varsLeft->serialize_group_name);

        return $this->render(
            $template,
            [
                'boxLeft' => $boxLeft,
                'objectsLeft' => $objectsLeft,
            ]
        );
    }

}
