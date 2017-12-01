<?php

namespace CoreBundle\Services\ModuleBuilder\Module;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Services\ModuleBuilder\ExtendsClass\Base;
use CoreBundle\Services\ModuleBuilder\Interfaces\IModule;
use CoreBundle\Services\Common\Action;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEItem;
use BackendBundle\Form\TemplateEItemType;
use CoreBundle\Services\Crud\Builder\CrudMapper;


class Item extends Base implements IModule
{

    const GROUP_NAME = 'template_e_item';

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    public function insDeleteTemplate()
    {
        return 'Crud/Delete/Item';
    }

    public function insFormTemplate()
    {
        return 'Crud/Form/Item';
    }

    public function insViewTemplate()
    {
        return 'Crud/Informative/Item';
    }

    public function insFormType()
    {
        return TemplateEItemType::class;
    }

    public function insClassPath()
    {
        return TemplateEItem::class;
    }

    public function insGroupName()
    {
        return self::GROUP_NAME;
    }

    public function insModuleObject(TemplateHasModule $templateHasModule)
    {
        return;
    }

    public function insSave(TemplateHasModule $templateHasModule)
    {
        return;
    }

    public function insModuleTemplate()
    {
        $template = $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:4_crud.html.twig';

        if($this->templating->exists($template)) {
            return $template;
        }

        return $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:99_error.html.twig';
    }

    public function insCrudDefaults()
    {
        $crud = $this->container->get('core.service.crud');
        $crudMapper = $crud->getCrudMapper();

        $crudMapper
//            ->add('class_path', Role::class)
//            ->add('group_name', 'role')
            ->add('section_title', 'Gestionar items')
            ->add('section_icon', 'table')
            ->add('section_box_class', 'solid')
            ->add('route_create', $crudMapper->switchRoute(Action::CREATE))
            ->add('route_edit', $crudMapper->switchRoute(Action::EDIT))
            ->add('route_view', $crudMapper->switchRoute(Action::VIEW))
            ->add('route_delete', $crudMapper->switchRoute(Action::DELETE))
            ->add('route_info', $crudMapper->switchRoute(Action::INFO))
            ->add('modal_create_size', CrudMapper::MODAL_SIZE_LARGE)
            ->add('modal_edit_size', CrudMapper::MODAL_SIZE_LARGE)
        ;

        return $crudMapper->getDefaults();
    }

    public function insCrudDataTable(TemplateHasModule $templateHasModule)
    {
        $crud = $this->container->get('core.service.crud');
        $dataTable = $crud->getDataTableMapper();

        $dataTable
            ->addColumn('#', " '<span class=\"badge bg-blue\">' + obj.id_increment + '</span>' ")
            ->addColumn('name', 'obj.name')
            ->addColumn('excerpt', 'obj.excerpt')
            ->addColumn('Creado', 'obj.created_at', [
                'icon' => 'calendar'
            ])
            ->addButtonTable(['edit', 'delete'], 'obj.id_increment')
            ->addButtonHeader(['create', 'info'])
            ->addRowCallBack('id', 'aData.id_increment')
            ->addRowCallBack('data-id', 'aData.id_increment')
            ->addRowCallBack('class', ' "alert" ')
        ;

        $entity = $this->entityManager->getRepository(TemplateEItem::class)->findAllByTemplateHasModule($templateHasModule);
        $entity = $this->getSerialize($entity, self::GROUP_NAME);
        $dataTable->setData($entity);

        return $dataTable;
    }

}