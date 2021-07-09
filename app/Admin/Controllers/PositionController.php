<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Actions\BackupRun;
use App\Admin\Components\Actions\SendSms;
use App\Model\Position;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PositionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '位置检测';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Position());

        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new SendSms());

            $tools->disableBatchActions();
        });
        $grid->column('id', __('Id'));
        $grid->column('t1', __('经纬度'));
        $grid->column('t2', __('具体位置'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Position::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('t1', __('经纬度'));
        $show->field('t2', __('具体位置'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Position());

        $form->text('t1', __('经纬度'));
        $form->text('t2', __('具体位置'));

        return $form;
    }
}
