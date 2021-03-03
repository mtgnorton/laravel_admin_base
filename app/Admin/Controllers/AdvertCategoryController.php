<?php

namespace App\Admin\Controllers;

use App\Model\AdvertCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdvertCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    public function __construct()
    {
        $this->title = ll('Advert category manage');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdvertCategory());

        $grid->column('id', ll('Id'));
        $grid->column('name', ll('Advert category name'));
        $grid->column('identifying', ll('Advert category identifying'));
        $grid->column('width', ll('Advert suggest width'));
        $grid->column('height', ll('Advert suggest height'));
        $grid->column('created_at', ll('Created at'));
        $grid->column('updated_at', ll('Updated at'));

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdvertCategory());

        $form->text('name', ll('Advert category name'));
        $form->text('identifying', ll('Advert category identifying'))->help(ll("the value can't modify"));
        $form->number('width', ll('Advert suggest width'));
        $form->number('height', ll('Advert suggest height'));

        return $form;
    }
}
