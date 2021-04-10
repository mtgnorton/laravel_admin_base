<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Actions\ModifyPassword;
use App\Admin\Components\Renders\PostRender;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;

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
//        $grid->column('password_modify', ll('Password modify'))->action(ModifyPassword::class);

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

        if ($form->isEditing()) {
            $form->display('parent_id', ll('Parent user id'));
        } else {
            $form->number('parent_id', ll('Parent user id'))->default(0);
        }
        $form->text('username', ll('Username'));
        $form->email('email', ll('Email'));
        $form->mobile('mobile', ll('Mobile'));
        $form->switch('is_disabled', ll('Is disabled'))->states([
            'on'  => ['value' => 1, 'text' => ll('Yes'), 'color' => 'danger'],
            'off' => ['value' => 0, 'text' => ll('No'), 'color' => 'primary']
        ]);

        $form->text('last_token', ll('Last token'));

        $form->password('password', ll('Password'))->help(ll("input modify"))->rules("required|min:6|confirmed");

        $form->password('password_confirmation', ll('Password confirmation'))->default(function (Form $form) {

            return $form->model()->password;
        })->required();

        $form->password('pay_password', ll('Pay password'))->help(ll("input modify"));

        $form->password('pay_password_confirmation', ll('Pay password confirmation'))->default(function (Form $form) {
            return $form->model()->pay_password;
        });

        $form->ignore(['password_confirmation', 'pay_password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }

            if ($form->pay_password && $form->model()->pay_password != $form->pay_password) {
                $form->pay_password = Hash::make($form->pay_password);
            }

        });

        $form->saved(function (Form $form) {
            $user = $form->model();

            if ($form->isCreating()){
                if ($form->parent_id) {
                    $parent = User::find($form->parent_id);
                    if (!$parent) {
                        $user->delete();
                        return form_error(ll('Parent not exist'));
                    }
                    $user->createRelation($parent);
                }

            }
        });
        return $form;
    }
}
