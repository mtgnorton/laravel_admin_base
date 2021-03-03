<?php

namespace App\Admin\Controllers;

use App\Model\Comment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Comment());

        $grid->column('id', ll('Id'));
        $grid->column('user_id', ll('User id'));
        $grid->column('post_id', ll('Post id'));
        $grid->column('content', ll('Content'));
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
        $form = new Form(new Comment());

        $form->number('user_id', ll('User id'));
        $form->number('post_id', ll('Post id'));
        $form->textarea('content', ll('Content'));

        return $form;
    }
}
