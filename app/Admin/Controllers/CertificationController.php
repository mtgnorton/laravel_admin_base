<?php

namespace App\Admin\Controllers;

use App\Model\Certification;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CertificationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    protected $statusText;

    public function __construct()
    {
        $this->title      = ll('Certification list');
        $this->statusText = [
            Certification::STATUS['REFUSE']     => ll('Refuse'),
            Certification::STATUS['NO AUDIT']   => ll('No audit'),
            Certification::STATUS['PASS AUDIT'] => ll('Pass audit'),
        ];
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Certification());

        $grid->column('id', ll('Id'));
        $grid->column('user_id', ll('User id'));
        $grid->column('username', ll('Username'));
        $grid->column('name', ll('True name'));
        $grid->column('id_card', ll('Id card'));
        $grid->column('card_image_front', ll('Card image front'))->gallery(['width' => 100, 'height' => 100]);
        $grid->column('card_image_behind', ll('Card image behind'))->gallery(['width' => 100, 'height' => 100]);
        $grid->column('status', ll('Status'))->using($this->statusText)->label(
            [
                Certification::STATUS['REFUSE']     => 'error',
                Certification::STATUS['NO AUDIT']   => 'default',
                Certification::STATUS['PASS AUDIT'] => 'success',
            ]
        );
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
        $form = new Form(new Certification());
        $form->number('user_id', ll('User id'));
        $form->number('username', ll('Username'));
        $form->text('name', ll('True name'))->required();
        $form->text('id_card', ll('Id card'))->required();
        $form->image('card_image_front', ll('Card image front'));
        $form->image('card_image_behind', ll('Card image behind'));
        $form->radio('status', ll('Status'))->options($this->statusText);

        $form->saving(function (Form $form) {


            if ($form->isCreating() && Certification::where('user_id', $form->user_id)->exists()) {
                return form_error(ll('user has certification'));
            }

            if ($form->model()->status == 0) { //已经审核不能再次审核
                if ($form->status == 1) {
                    User::where('id', $form->user_id)->update([
                        'certification_level' => Certification::TYPE['KYC1']
                    ]);
                    list($provider) = app('UserService')->getAuthProviderAndToken();
                    $provider->updateUserInfo(User::find($form->user_id));
                }
            } else {
                if ($form->status != $form->model()->status) {
                    return form_error(ll('user has audit'));
                }
            }
        });

        return $form;
    }
}
