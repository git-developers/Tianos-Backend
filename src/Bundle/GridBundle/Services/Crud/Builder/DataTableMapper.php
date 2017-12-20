<?php

namespace Bundle\GridBundle\Services\Crud\Builder;

use Bundle\ResourceBundle\Controller\RequestConfiguration;

class DataTableMapper
{

    const COLUMN = 'columns';
    const DATATABLE = 'data_table';
    const BUTTON_HEADER = 'button_header';

    const TABLE_NAME = 'table-grid';
    const TABLE_TR_CLASS = 'row-tr-class';
    const TABLE_TD_CLASS = 'row-td-class';

//    private $i;
//    private $configuration;
    private $grid;

    protected $data;
    protected $tableOptions;
    protected $options;

    public $columns;
    public $columnsTargets;
    public $buttonTable;
    public $buttonHeader;
    public $rowCallBack;

    public function __construct(array $grid = [])
    {
//        $this->grid = $grid;

//        $this->columns = $this->buildColumn();

//        $this->i = 0;
//        $this->options = $this->optionsDefault();
        $this->data = json_encode([]);
//        $this->columnsTargets = '';
    }

    public function addRowCallBack($key, $value)
    {
        $this->rowCallBack[$key] = $value;

        return $this;
    }

//    public function addColumn($name, $obj = null, array $options = [])
//    {
//
////        $options = array_replace([
////            'icon' => 10,
////        ], $options);
//
//        $this->columns[$this->i]['name'] = $name;
//        $this->columns[$this->i]['obj'] = $obj;
//        $this->columns[$this->i]['options'] = $options;
//        $this->i ++;
//
//        $this->setColumnsTargets($this->i);
//
//        return $this;
//    }

//    public function buildColumn()
//    {
//        return $this->configuration->getGridDataTable(self::COLUMN);
//
//
////        return $this->columns;
//
////        return $this;
//    }

    public function addButtonTable(array $actions = [], $dataId = null)
    {
//        $button = new Button(['data-id' => $dataId]);
//
//        $buttons = [
//            'edit' => $button->edit(),
//            'delete' => $button->delete(),
//        ];
//
//        foreach ($actions as $key => $value){
//            if(array_key_exists($value, $buttons)){
//                $this->buttonTable[] = $buttons[$value];
//            }
//        }
//
//        return $this;
    }

//    public function addButtonHeader(array $actions = [])
//    {
//        $button = new Button();
//
//        $buttons = [
//            'create' => $button->create(),
//            'info' => $button->info(),
//        ];
//
//        foreach ($actions as $key => $value){
//            if(array_key_exists($value, $buttons)){
//                $this->buttonHeader[] = $buttons[$value];
//            }
//        }
//
//        return $this;
//    }

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

        return $this;
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

        return $this;
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
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns(array $grid = [])
    {
        if (!isset($grid[DataTableMapper::DATATABLE][DataTableMapper::COLUMN])) {
            $this->columns = [];

            return $this;
        }

        $this->columns = $grid[DataTableMapper::DATATABLE][DataTableMapper::COLUMN];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTableOptions()
    {
        return $this->tableOptions;
    }

    /**
     * @param mixed $tableOptions
     */
    public function setTableOptions(array $tableOptions = [])
    {
        $this->tableOptions = array_replace([
            'table_name' => self::TABLE_NAME,
            'table_tr_class' => self::TABLE_TR_CLASS,
            'table_td_class' => self::TABLE_TD_CLASS,
        ], $tableOptions);

        return $this;
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
    public function setColumnsTargets()
    {
        $columnsCount = count($this->columns) - 1;
        $columnsCount = range(0, $columnsCount);
        $columnsCount = json_encode($columnsCount);

        $this->columnsTargets = $columnsCount;

        return $this;
    }

}
