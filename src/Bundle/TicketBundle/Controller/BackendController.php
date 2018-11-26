<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\Controller;

use Bundle\GridBundle\Controller\GridController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use JMS\Serializer\SerializationContext;
use Bundle\CategoryBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Session\Session;

class BackendController extends GridController
{

	const INCREMENT = 'INCREMENT';
	const DECREMENT = 'DECREMENT';
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function createAction(Request $request): Response
	{
		
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
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		//REPOSITORY TREE
		$objectsTreeParent = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_SERVICE);
		$objectsTree = $this->getTreeEntities($objectsTreeParent, $configuration, 'tree');
		
		$entity = [];
		$servicesObjs = $this->getServices($objectsTreeParent, $configuration, 'ticket', $entity);
		//REPOSITORY TREE
		
		
		//SERVICES
		$serviceArray = [];
		$session = $request->getSession();
		$services = $session->get('services');
		
		foreach ($services as $key => $service) {
			$serviceObj = $this->get('tianos.repository.services')->find($service['idService']);
			$serviceObj->setQuantity($service['quantity']);
			$serviceArray[] = $this->getSerializeDecode($serviceObj, 'ticket');
		}
		//SERVICES
		
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
				'tree' => $tree,
				'vars' => $vars,
				'action' => $action,
				'servicesObjs' => $servicesObjs,
				'objectsTree' => $objectsTree,
				'services' => $serviceArray
//				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function addClienteAction(Request $request): Response
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
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		$clients = $this->get('tianos.repository.user')->findAllClient();
		$clients = $this->getSerializeDecode($clients, 'ticket');
		
		if ($form->isSubmitted() && $form->isValid()) {
			
			$client = $request->get('client');
			$client = (int) array_shift($client);
			
			$client = $this->get('tianos.repository.user')->findOneById($client);
			$client = $this->getSerializeDecode($client, 'ticket');
			
			return $this->render(
				'TicketBundle:BackendTicket/Grid/Box:table_client.html.twig',
				[
					'status' => $client ? self::STATUS_SUCCESS : self::STATUS_ERROR,
					'client' => $client
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'clients' => $clients,
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function addEmployeeAction(Request $request): Response
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
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
		$employees = $this->get('tianos.repository.user')->findAllEmployee();
		$employees = $this->getSerializeDecode($employees, 'ticket');
		
		if ($form->isSubmitted()) {
			
			$employees = $request->get('employee');
			
			$idEmployees = [];
			foreach ($employees as $key => $employee) {
				
				if (!is_array($employee)) {
					continue;
				}
				
				$idEmployees[] = (int) array_shift($employee);
			}
			
			$employees = $this->get('tianos.repository.user')->findAllByIds($idEmployees);
			$employees = $this->getSerializeDecode($employees, 'ticket');
			
			return $this->render(
				'TicketBundle:BackendTicket/Grid/Box:table_employee.html.twig',
				[
					'status' => empty($employees) ? self::STATUS_ERROR : self::STATUS_SUCCESS,
					'employees' => $employees
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'employees' => $employees,
				'action' => $action,
				'form' => $form->createView(),
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function incrementDecrementServicesAction(Request $request): Response
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
		
		$serviceArray = [];
		$session = $request->getSession();
		$action = $request->get('action');
		
		$this->incrementDecrementSession($request, $action);
		
		$services = $session->get('services');
		
		foreach ($services as $key => $service) {
			$serviceObj = $this->get('tianos.repository.services')->find($service['idService']);
			$serviceObj->setQuantity($service['quantity']);
			$serviceArray[] = $this->getSerializeDecode($serviceObj, 'ticket');
		}

		return $this->render(
			$template,
			[
				'services' => $serviceArray
			]
		);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function removeAllServicesAction(Request $request): Response
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
		
		$session = $request->getSession();
		$session->remove('services');
		
		return $this->render(
			$template,
			[
				'status' => self::STATUS_SUCCESS,
				'services' => []
			]
		);
	}
	
	private function getTreeEntities($parents, $configuration, $serializeGroupName)
	{
		if(is_null($parents)){
			$parents = [];
		}
		
		$entity = [];
		foreach ($parents as $key => $parent) {
			$entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$entity[$key]['children'] = $this->getTreeEntities($children, $configuration, $serializeGroupName);
		}
		
		return $entity;
	}
	
	private function getServices($parents, $configuration, $serializeGroupName, &$entity)
	{
		if(is_null($parents)){
			$parents = [];
		}
		
		foreach ($parents as $key => $parent) {
			
			$services = $this->get('tianos.repository.services')->findAllByCategory($parent);
			$result_1 = $this->getSerializeDecode($services, $serializeGroupName);
			
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$result_2 = $this->getServices($children, $configuration, $serializeGroupName, $entity);
			
			$entity = array_merge($result_1, $result_2);
		
		}

		return $entity;
	}
	
	private function incrementDecrementSession(Request $request, $action = self::INCREMENT)
	{
		
		//SESSION
		$idService = $request->get('idService');
		
		$session = $request->getSession();
		
		$services = $session->get('services');
		
		if (is_null($services))
		{
			$session->set('services', []);
		}
		
		$services = $session->get('services');
		
		$exist = false;
		foreach ($services as $key => $service) {
			
			if ($service['idService'] == $idService) {
				
				if ($action == self::DECREMENT AND $service['quantity'] >= 1) {
					$array[] = [
						'idService' => $idService,
						'quantity' => --$service['quantity']
					];
				}
				
				if ($action == self::INCREMENT) {
					$array[] = [
						'idService' => $idService,
						'quantity' => ++$service['quantity']
					];
				}
				
				unset($services[$key]);
				$session->set('services', array_merge($services, $array));
				
				$exist = true;
				break;
			}
		}
		
		$services = $session->get('services');
		
		// QUITAR CON ZEROS
		foreach ($services as $key => $service) {
			if ($service['quantity'] == 0) {
				unset($services[$key]);
				$session->set('services', $services);
			}
		}

		if (!$exist) {
			$session->set('services', array_merge($services, [
				[
					'idService' => $idService,
					'quantity' => 1,
				]
			]));
		}
	}
}
