<?php

namespace CoreBundle\Services\CrudUser\Builder;


class DataTableMapper
{
    private $i;
    protected $data;
    public $columns;
    public $columnsTargets;
    public $buttonTable;
    public $buttonHeader;
    protected $options;
    public $rowCallBack;

    public function __construct()
    {
        $this->i = 0;
        $this->options = $this->optionsDefault();
        $this->data = [];
        $this->columnsTargets = json_encode([]);
        $this->buttonTable = [];
        $this->columns = [];
    }

    public function addRowCallBack($key, $value)
    {
        $this->rowCallBack[$key] = $value;

        return $this;
    }

    public function addColumn($name, $obj = null, array $options = [])
    {

//        $options = array_replace([
//            'icon' => 10,
//        ], $options);

        $this->columns[$this->i]['name'] = $name;
        $this->columns[$this->i]['obj'] = $obj;
        $this->columns[$this->i]['options'] = $options;
        $this->i ++;

        $this->setColumnsTargets($this->i);

        return $this;
    }

    public function addButtonTable(array $actions = [], $dataId = null)
    {
        $button = new Button(['data-id' => $dataId]);

        $buttons = [
            'edit' => $button->edit(),
            'delete' => $button->delete(),
            'change_password' => $button->changePassword(),
        ];

        foreach ($actions as $key => $value){
            if(array_key_exists($value, $buttons)){
                $this->buttonTable[] = $buttons[$value];
            }
        }

        return $this;
    }

    public function addButtonHeader(array $actions = [])
    {
        $button = new Button();

        $buttons = [
            'create' => $button->create(),
            'info' => $button->info(),
        ];

        foreach ($actions as $key => $value){
            if(array_key_exists($value, $buttons)){
                $this->buttonHeader[] = $buttons[$value];
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions(array $options = [])
    {
        $this->options = array_replace($this->optionsDefault(), $options);
    }

    private function optionsDefault()
    {
        return [
            'pageLength' => 10,
            'lengthMenu' => json_encode([
                [10, 50, 100, 150, -1],
                [10, 50, 100, 150, 'Todos']
            ]),
            'order' => json_encode([
                [
                    0, 'desc'
                ]
            ]),
            'dom' => '\'<"top"iflp><"clear">rt<"bottom"iflp>\'',
            'ordering' => true,
            'paging' => true,
            'info' => true,
            'autoWidth' => true,
            'filter' => true,
        ];
    }

    /**
     * @return mixed
     */
    public function getColumnsTargets()
    {
        return $this->columnsTargets;
    }

    /**
     * @param mixed $columnsTargets
     */
    public function setColumnsTargets($columnsTargets)
    {
        $columnsTargets = $columnsTargets - 1;
        $columnsTargets = range(0, $columnsTargets);
        $columnsTargets = json_encode($columnsTargets);

        $this->columnsTargets = $columnsTargets;
    }

}
