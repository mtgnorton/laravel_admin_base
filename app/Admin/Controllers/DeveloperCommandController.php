<?php

namespace App\Admin\Controllers;


use App\Admin\Components\Actions\RestartGoClear;
use App\Model\DeveloperCommand;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;

class DeveloperCommandController extends AdminController
{

    protected $title;

    public function __construct()
    {
        $this->title = ll('Developer commands');
    }

    public function grid()
    {
        $grid = new Grid(new DeveloperCommand());

        grid_disabled_all($grid);

        $grid->column('operation', ll('操作'))->display(function ($action, $column) use ($grid) {


            /** @var RowAction $action */
            $action = new $action();

            return $action
                ->asColumn()
                ->setGrid($grid)
                ->setColumn($column)
                ->setRow($this);
        })->style("text-align: center;");
        $grid->column('desc', ll('概述'))->width(800);


        return $grid;
    }


}
