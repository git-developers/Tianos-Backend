<?php

namespace CoreBundle\Services\Crud\Builder;

class Button
{
    const TEST = 'test';

    protected $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function edit()
    {
        $attr = [
            'class' => 'btn btn-warning btn-xs ' . CrudMapper::MODAL_EDIT_ID,
            'alt' => 'Editar',
            'title' => 'Editar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_EDIT_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-pencil"></i></button>';

        return $out;
    }

    public function delete()
    {
        $attr = [
            'class' => 'btn btn-danger btn-xs ' . CrudMapper::MODAL_DELETE_ID,
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_DELETE_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-trash"></i></button>';

        return $out;
    }

    public function create()
    {
        $attr = [
            'class' => 'btn btn-success btn-xs ' . CrudMapper::MODAL_CREATE_ID,
            'alt' => 'Crear item',
            'title' => 'Crear item',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_CREATE_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-plus"></i> crear item</button>';

        return $out;
    }

    public function info()
    {
        $attr = [
            'class' => 'btn btn-info btn-xs ' . CrudMapper::MODAL_INFO_ID,
            'alt' => 'Info',
            'title' => 'Info',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudMapper::MODAL_INFO_ID,
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-info-circle"></i> info</button>';

        return $out;
    }

}



