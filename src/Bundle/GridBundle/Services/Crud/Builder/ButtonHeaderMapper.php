<?php

namespace Bundle\GridBundle\Services\Crud\Builder;

class ButtonHeaderMapper
{

    protected $buttons;

    public function __construct(array $grid = [])
    {
        $this->buttons = $this->getButtons($grid);

    }

    public function getButtons(array $grid = [])
    {

        if (!isset($grid[DataTableMapper::DATATABLE][DataTableMapper::BUTTON_HEADER])) {
            return [];
        }

        return $grid[DataTableMapper::DATATABLE][DataTableMapper::BUTTON_HEADER];
    }

    public function getDefaults()
    {
        $out = [];

        foreach ($this->buttons as $key => $button){
            $out[$button] = $this->$button();
        }

        return $out;
    }

    private function create()
    {
        return new Button([
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'icon' => '<i class="fa fa-fw fa-plus"></i>',
            'data-target' => ModalMapper::MODAL_CREATE_ID,
            'class' => 'btn btn-success btn-xs ' . ModalMapper::MODAL_CREATE_ID,
        ]);
    }

    private function edit()
    {
        return new Button([
            'alt' => 'Editar',
            'title' => 'Editar',
            'icon' => '<i class="fa fa-fw fa-pencil"></i>',
            'data-target' => ModalMapper::MODAL_EDIT_ID,
            'class' => 'btn btn-warning btn-xs ' . ModalMapper::MODAL_EDIT_ID,
        ]);
    }

    private function delete()
    {
        return new Button([
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'icon' => '<i class="fa fa-fw fa-trash"></i>',
            'data-target' => ModalMapper::MODAL_DELETE_ID,
            'class' => 'btn btn-danger btn-xs ' . ModalMapper::MODAL_DELETE_ID,
        ]);
    }

    private function info()
    {
        return new Button([
            'alt' => 'Info',
            'title' => 'Info',
            'data-target' => ModalMapper::MODAL_INFO_ID,
            'icon' => '<i class="fa fa-fw fa-info-circle"></i>',
            'class' => 'btn btn-info btn-xs ' . ModalMapper::MODAL_INFO_ID,
        ]);
    }

}



