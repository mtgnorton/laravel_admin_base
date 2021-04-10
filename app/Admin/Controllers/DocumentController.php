<?php

namespace App\Admin\Controllers;

use App\Model\Document;
use App\Model\DocumentCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DocumentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Document';


    public function __construct()
    {
        $this->title = ll('Title');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Document());

        $grid->column('id', ll('Id'));
        $grid->column('title', ll('Title'));
        $grid->column('category_id', ll('Category'));
        $grid->column('identify', ll('Identify'));
        $grid->column('sort', ll('Sort'));
        $grid->column('is_disabled', ll('Is disabled'))->switch();
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
        $form = new Form(new Document());

        $form->text('title', ll('Title'));
        $form->text('identify', ll('Identify'))->help(ll("the value can't modify"));
        $form->select('category_id', ll('Category'))->options(DocumentCategory::selectOptions());
        $form->fullEditor('content', ll('Content'));
        $form->number('sort', ll('Sort'))->default(0);
        $form->switch('is_disabled', ll('Is disabled'));

        return $form;
    }
}
