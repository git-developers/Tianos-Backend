<?php

namespace CoreBundle\Services\CrudUser\Builder;

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
            'class' => 'btn btn-warning btn-xs ' . CrudUserMapper::MODAL_EDIT_ID,
            'alt' => 'Editar',
            'title' => 'Editar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudUserMapper::MODAL_EDIT_ID,
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
            'class' => 'btn btn-danger btn-xs ' . CrudUserMapper::MODAL_DELETE_ID,
            'alt' => 'Eliminar',
            'title' => 'Eliminar',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudUserMapper::MODAL_DELETE_ID,
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
            'class' => 'btn btn-success btn-xs ' . CrudUserMapper::MODAL_CREATE_ID,
            'alt' => 'crear item',
            'title' => 'crear item',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudUserMapper::MODAL_CREATE_ID,
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
            'class' => 'btn btn-info btn-xs ' . CrudUserMapper::MODAL_INFO_ID,
            'alt' => 'info',
            'title' => 'info',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudUserMapper::MODAL_INFO_ID,
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-info-circle"></i> info</button>';

        return $out;
    }

    public function changePassword()
    {
        $attr = [
            'class' => 'btn bg-purple btn-xs ' . CrudUserMapper::MODAL_CHANGE_PASSWORD_ID,
            'alt' => 'cambiar password',
            'title' => 'cambiar password',
            'data-toggle' => 'modal',
            'data-target' => '#' . CrudUserMapper::MODAL_CHANGE_PASSWORD_ID,
            'style' => 'margin-right: 5px',
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-key"></i></button>';

        return $out;
    }

}



