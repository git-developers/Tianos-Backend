<?php

declare(strict_types=1);

namespace Bundle\UserBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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

    /**
     * @param Request $request
     * @return Response
     */
    public function changePasswordAction(Request $request): Response
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
        $entity = $configuration->getEntity();
        $entity = new $entity();

        //REPOSITORY
        $id = $request->get('id');
        $user = $this->get($repository)->$method($id);

        if (!$user) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $form = $this->createForm($formType, $entity, ['form_data' => []]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $status = self::STATUS_ERROR;

            try{

                if ($form->isValid()) {

                    $plainPassword = $entity->getNewPassword();
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                    $encodedPassword = $encoder->encodePassword($plainPassword, $user->getSalt());
                    $user->setPassword($encodedPassword);

                    $this->persist($user);

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
	
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function profileAction(Request $request): Response
	{
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_EDIT_USER')) {
//            return $this->redirectToRoute('frontend_default_access_denied');
//        }
		
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
		$vars = $configuration->getVars();
		
		$slug = $request->get('slug', null);
		
		$entity = $this->get($repository)->$method($slug);
		
		$isFriend = $this->get('tianos.repository.friends')->isFriend($entity->getUsername(), $this->getUser()->getId());
		$lastGoogleDriveFiles = $this->get('tianos.repository.google.drive')->lastFiles($this->getUser()->getId());
		
		if (!$entity) {
			throw $this->createNotFoundException('El usuario que busca no existe');
		}
		
		return $this->render(
			$template,
			[
				'vars' => $vars,
				'small_text' => '',
				'entity' => $entity,
				'isFriend' => $isFriend,
				'lastGoogleDriveFiles' => $lastGoogleDriveFiles,
			]
		);
	}

}
