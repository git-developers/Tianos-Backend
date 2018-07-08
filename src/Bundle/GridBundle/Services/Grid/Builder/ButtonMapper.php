<?php

namespace Bundle\GridBundle\Services\Grid\Builder;

use Bundle\CoreBundle\Services\Button;
use Bundle\CoreBundle\Services\ModalMapper;
use Symfony\Component\Debug\Exception\UndefinedMethodException;

class ButtonMapper
{

    private $grid;
    protected $buttons;

    public function __construct(array $grid = [])
    {
        $this->grid = $grid;
    }

    public function getTableHeaderButton()
    {
        if (!isset($this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON_HEADER])) {
            return [];
        }

        $out = [];
        $buttons = $this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON_HEADER];

        foreach ($buttons as $key => $button){
            $out[$button] = $this->$button();
        }

        return $out;
    }

    public function getTableButton()
    {
        if (!isset($this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON])) {
            return [];
        }

        $out = [];
        $buttons = $this->grid[DataTableMapper::DATATABLE][DataTableMapper::TABLE_BUTTON];


//        echo "POLLO:: <pre>";
//        print_r($buttons);
//        exit;

        foreach ($buttons as $key => $button) {

            try {

                $out[$button] = $this->$button();

            } catch (\Throwable $e) {

            }
        }

        return $out;
    }

    private function create()
    {
        return new Button([
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'icon' => '<i class="fa fa-fw fa-plus"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::CREATE_ID,
            'class' => 'btn-success ' . ModalMapper::CREATE_ID,
        ]);
    }

    private function edit()
    {
        return new Button([
            'alt' => 'Editar',
            'title' => 'Editar',
            'icon' => '<i class="fa fa-fw fa-pencil"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::EDIT_ID,
            'class' => 'btn-warning ' . ModalMapper::EDIT_ID,
        ]);
    }

    private function delete()
    {
        return new Button([
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'icon' => '<i class="fa fa-fw fa-trash"></i>',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::DELETE_ID,
            'class' => 'btn-danger ' . ModalMapper::DELETE_ID,
        ]);
    }

    private function info()
    {
        return new Button([
            'alt' => 'Info',
            'title' => 'Info',
            'data-toggle' => 'modal',
            'data-target' => ModalMapper::INFO_ID,
            'icon' => '<i class="fa fa-fw fa-info-circle"></i>',
            'class' => 'btn-info ' . ModalMapper::INFO_ID,
        ]);
    }

    private function watch()
    {
        return new Button([
            'alt' => 'Ver archivo',
            'title' => 'Ver archivo',
//            'data-target' => ModalMapper::WATCH_ID,
            'icon' => '<i class="fa fa-fw fa-eye"></i>',
            'class' => 'btn-info ' . ModalMapper::WATCH_ID,
        ]);
    }

}



