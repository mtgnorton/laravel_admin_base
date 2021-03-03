<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Actions\ModifyPassword;
use App\Admin\Components\Renders\PostRender;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    public function __construct()
    {
        $this->title = ll('User list');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', ll('Id'));
        $grid->column('username', ll('Username'));
        $grid->column('see_post', ll('See post'))->customModal(ll('Post list'), PostRender::class);
        $grid->column('email', ll('Email'));
        $grid->column('mobile', ll('Mobile'));
        $grid->column('is_disabled', ll('Is disabled'))->switch([
            'on'  => ['value' => 1, 'text' => ll('Yes'), 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => ll('No'), 'color' => 'primary']
        ]);

        $grid->column('created_at', ll('Created at'));
        $grid->column('updated_at', ll('Updated at'));
        $grid->column('password_modify', ll('Password modify'))->action(ModifyPassword::class);

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('username', ll('Username'));
        $form->email('email', ll('Email'));
        $form->mobile('mobile', ll('Mobile'));
        $form->switch('is_disabled', ll('Is disabled'))->switch([
            'on'  => ['value' => 1, 'text' => ll('Yes'), 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => ll('No'), 'color' => 'primary']
        ]);;
        $form->text('last_token', ll('Last token'));
        return $form;
    }
}
