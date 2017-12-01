<?php

namespace CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Services\Common\Action;
use CoreBundle\Services\Crud\Builder\CrudMapper;
use CoreBundle\Services\Crud\Builder\DataTableMapper;

class CrudController extends BaseController
{

    public function index(CrudMapper $crudMapper, DataTableMapper $dataTable)
    {

        $this->denyAccessUnlessGranted($crudMapper->role(Action::VIEW), null, self::ACCESS_DENIED_ROLE_MSG);

        $crudMapper
            ->add('route_create', $crudMapper->switchRoute(Action::CREATE))
            ->add('route_edit', $crudMapper->switchRoute(Action::EDIT))
            ->add('route_view', $crudMapper->switchRoute(Action::VIEW))
            ->add('route_delete', $crudMapper->switchRoute(Action::DELETE))
            ->add('route_info', $crudMapper->switchRoute(Action::INFO))
        ;

        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->findAll();
        $entity = $this->getSerialize($entity, $crud['group_name']);
        $dataTable->setData($entity);

        return $this->render(
            'CoreBundle:Crud:index.html.twig',
            [
                'crud' => $crud,
                'dataTable' => $dataTable,
            ]
        );

    }

    public function create(Request $request, CrudMapper $crudMapper)
    {

        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($crudMapper->role(Action::CREATE))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::CREATE,
                ]
            );
        }

        $crudMapper
            ->add('template_create', $crudMapper->getFormTemplate())
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $crud = $crudMapper->getDefaults();
        $options = !empty($crud['form_data']) ? ['form_data' => $crud['form_data']] : ['form_data' => []];

        $entity = new $crud['class_path']();
        $form = $this->createForm($crud['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $crud['group_name']);
                    $status = self::AJAX_STATUS_SUCCESS;
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
                'entity' => $entityJson,
            ]);
        }

        return $this->render(
            $this->validateTemplate($crud['template_create']),
            [
                'crud' => $crud,
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function edit(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($crudMapper->role(Action::EDIT))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::EDIT,
                ]
            );
        }

        $crudMapper
            ->add('template_edit', $crudMapper->getFormTemplate())
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        $options = !empty($crud['form_data']) ? ['form_data' => $crud['form_data']] : ['form_data' => []];
        $form = $this->createForm($crud['form_type'], $entity, $options);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $errors = [];
            $entityJson = null;
            $status = self::AJAX_STATUS_ERROR;

            try{

                if ($form->isValid()) {
                    $this->persist($entity);
                    $entityJson = $this->getSerializeDecode($entity, $crud['group_name']);
                    $status = self::AJAX_STATUS_SUCCESS;
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
                'entity' => $entityJson,
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($crud['template_edit']),
            [
                'id' => $id,
                'crud' => $crud,
                'formEntity' => $form->createView(),
            ]
        );
    }

    public function delete(Request $request, CrudMapper $crudMapper)
    {

        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($crudMapper->role(Action::DELETE))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::DELETE,
                ]
            );
        }

        $crudMapper
            ->add('template_delete', $crudMapper->getDeleteTemplate())
            ->add('test', 'test', [
                'label' => '',
            ])
        ;

        $errors = [];
        $status = self::AJAX_STATUS_ERROR;

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();

        if ($request->isMethod('DELETE')) {

            $repository = $this->em()->getRepository($crud['class_path']);
            $entity = $repository->find($id);

            try {
                if($entity){
                    $entity->setIsActive(false);
                    //$this->remove($entity);
                    $this->persist($entity);
                    $status = self::AJAX_STATUS_SUCCESS;
                }
            }catch (\Exception $e){
                $errors[] = $e->getMessage();
            }

            return $this->json([
                'status' => $status,
                'errors' => $errors,
                'id' => $id,
            ]);
        }

        return $this->render(
            $this->validateTemplate($crud['template_delete']),
            [
                'id' => $id,
                'form_data' => $crud['form_data'],
            ]
        );
    }

    public function view(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest()) {
            throw $this->createAccessDeniedException(self::ACCESS_DENIED_MSG);
        }

        if (!$this->isGranted($crudMapper->role(Action::VIEW))) {
            return $this->render(
                'CoreBundle:Crud:Template/access_denied.html.twig',
                [
                    'action' => Action::VIEW,
                ]
            );
        }

        $crudMapper
            ->add('template_view', $crudMapper->getViewTemplate())
        ;

        $id = $request->get('id');
        $crud = $crudMapper->getDefaults();
        $entity = $this->em()->getRepository($crud['class_path'])->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('CRUD: Unable to find  entity.');
        }

        return $this->render(
            $this->validateTemplate($crud['template_view']),
            [
                'entity' => $entity,
            ]
        );
    }

    public function info(Request $request, CrudMapper $crudMapper)
    {
        if (!$this->isXmlHttpRequest()) {
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
        );
    }

}