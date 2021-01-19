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
        $this->title = __('User list');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('see_post', __('See post'))->customModal(__('Post list'), PostRender::class);
        $grid->column('email', __('Email'));
        $grid->column('mobile', __('Mobile'));
        $grid->column('is_disabled', __('Is disabled'))->switch([
            'on'  => ['value' => 1, 'text' => __('Yes'), 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => __('No'), 'color' => 'primary']
        ]);

        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('password_modify', __('Password modify'))->action(ModifyPassword::class);

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

        $form->text('username', __('Username'));
        $form->email('email', __('Email'));
        $form->mobile('mobile', __('Mobile'));
        $form->switch('is_disabled', __('Is disabled'))->switch([
            'on'  => ['value' => 1, 'text' => __('Yes'), 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => __('No'), 'color' => 'primary']
        ]);;
        $form->text('last_token', __('Last token'));
        return $form;
    }
}
