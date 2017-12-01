<?php

namespace CoreBundle\Services\Template\Builder;

class Button
{
    const TEST = 'test';

    protected $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function info()
    {
        $attr = [
            'class' => 'btn btn-info btn-xs ' . TemplateMapper::MODAL_INFO_ID,
            'alt' => 'Info',
            'title' => 'Info',
            'data-toggle' => 'modal',
            'data-target' => '#' . TemplateMapper::MODAL_INFO_ID,
        ];

        $out = '<button ';
        foreach ($attr as $key => $value){
            $out .= $key . '="' . $value . '"';
        }
        $out .= ' ><i class="fa fa-fw fa-info-circle"></i> info</button>';

        return $out;
    }

}



