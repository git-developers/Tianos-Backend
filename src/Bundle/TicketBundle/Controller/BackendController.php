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

class BackendController extends GridController
{
	
	
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
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
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
				'vars' => $vars,
				'action' => $action,
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
	public function addServiceAction(Request $request): Response
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
		$tree = $configuration->getTree();
		$entity = $configuration->getEntity();
		$entity = new $entity();
		
		$form = $this->createForm($formType, $entity, ['form_data' => []]);
		$form->handleRequest($request);
		
//		$employees = $this->get('tianos.repository.user')->findAllEmployee();
//		$employees = $this->getSerializeDecode($employees, 'ticket');
		
		//REPOSITORY TREE
		$objectsTree = $this->get('tianos.repository.category')->findAllParentsByType(Category::TYPE_SERVICE);
		$objectsTree = $this->getTreeEntities($objectsTree, $configuration, 'tree');
		
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
				'TicketBundle:BackendTicket/Grid/Box:table_service.html.twig',
				[
					'status' => empty($employees) ? self::STATUS_ERROR : self::STATUS_SUCCESS,
					'employees' => $employees
				]
			);
		}
		
		return $this->render(
			$template,
			[
				'tree' => $tree,
				'action' => $action,
				'objectsTree' => $objectsTree,
				'form' => $form->createView(),
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
