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

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User id'));
        $grid->column('post_id', __('Post id'));
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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

        $form->number('user_id', __('User id'));
        $form->number('post_id', __('Post id'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
