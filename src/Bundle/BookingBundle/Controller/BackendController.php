<?php

declare(strict_types=1);

namespace Bundle\BookingBundle\Controller;

use Webmozart\Assert\Assert;
use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;

class BackendController extends GridController
{
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function calendarAction(Request $request): Response
	{
		$parameters = [
			'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
		];
		$applicationName = $this->container->getParameter('application_name');
		$this->metadata = new Metadata('tianos', $applicationName, $parameters);
		
		//CONFIGURATION
		$configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
		$template = $configuration->getTemplate('');
		$repository = $configuration->getRepositoryService();
		$method = $configuration->getRepositoryMethod();
		$template = $configuration->getTemplate('');
		$grid = $configuration->getGrid();
		$vars = $configuration->getVars();
		$modal = $configuration->getModal();
		
		//GRID
		$gridService = $this->get('tianos.grid');
		$modal = $gridService->getModalMapper()->getDefaults($modal);
		$formMapper = $gridService->getFormMapper()->getDefaults();

		Assert::notNull($template, 'Template is not configured.');
		
		
		//BOOKING
		$events = $this->get('tianos.repository.booking')->findAll();
		$out = [];
		foreach ($events as $key => $event) {
			
			$date = $event->getDateBook();
			$date = $date->format('Y-m-d');
			
			$out[] = [
				'title' => $event->getName(),
				'start' => $date,
				'backgroundColor' => '#449d44',
				'borderColor' => '#398439'
			];
		}
		$events = json_encode($out);
		//BOOKING
		

		return $this->render($template, [
			'form' => null,
			'vars' => $vars,
			'grid' => $grid,
			'modal' => $modal,
			'form_mapper' => $formMapper,
			'events' => $events
		]);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function calendarEventsAction(Request $request): JsonResponse
	{
		$events = $this->get('tianos.repository.booking')->findAll();

		$out = [];
		foreach ($events as $key => $event) {
			
			$date = $event->getDateBook();
			$date = $date->format('Y-m-d');
			
			$out[] = [
				'title' => $event->getName(),
				'bookingId' => $event->getId(),
				'start' => $date,
				'backgroundColor' => '#449d44',
				'borderColor' => '#449d44'
			];
		}

        return new JsonResponse($out);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function createAction(Request $request): Response
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
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => [
			'dateBook' => $request->get('dateBook')
		]]);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			
			$errors = [];
			$entityJson = null;
			$status = self::STATUS_ERROR;
			
			try{
				
				if ($form->isValid()) {
					
					$this->persist($entity);
					
					$varsRepository = $configuration->getRepositoryVars();
					$entity = $this->getSerializeDecode($entity, $varsRepository->serialize_group_name);
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
				'status' => $status,
				'errors' => $errors,
				'entity' => $entity,
			]);
		}
		
		return $this->render(
			$template,
			[
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
}
