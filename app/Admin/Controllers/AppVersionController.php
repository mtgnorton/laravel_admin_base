<?php

namespace App\Admin\Controllers;

use App\Model\AppVersion;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class AppVersionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    protected $clientText;

    protected $upgradeText;

    public function __construct()
    {
        $this->title       = ll('app version manage');
        $this->clientText  = [
            AppVersion::CLIENT_TYPE['ANDROID'] => ll('android'),
            AppVersion::CLIENT_TYPE['IOS']     => ll('ios')
        ];
        $this->upgradeText = [
            AppVersion::UPGRADE_TYPE['NO REMIND'] => ll('no remind upgrade'),
            AppVersion::UPGRADE_TYPE['REMIND']    => ll('remind upgrade'),
            AppVersion::UPGRADE_TYPE['FORCE']     => ll('force upgrade'),
        ];
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AppVersion());

        $grid->column('id', ll('Id'));
        $grid->column('version', ll('Version'));

        $grid->column('title', ll('Title'));
        $grid->column('description', ll('Description'));
        $grid->column('download_url', ll('Download url'));
        $grid->column('client_type', ll('Client type'))->using($this->clientText)->label([
            AppVersion::CLIENT_TYPE['ANDROID'] => 'info',
            AppVersion::CLIENT_TYPE['IOS']     => 'success'
        ]);
        $grid->column('upgrade_type', ll('Upgrade type'))->using($this->upgradeText)->dot([
            AppVersion::UPGRADE_TYPE['NO REMIND'] => 'primary',
            AppVersion::UPGRADE_TYPE['REMIND']    => 'info',
            AppVersion::UPGRADE_TYPE['FORCE']     => 'danger',
        ]);
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
        $form = new Form(new AppVersion());

        $form->text('version', ll('Version'))->rules('required|version');

        $form->text('title', ll('Title'))->default(ll('new version upgrade'))->rules('max:50');
        $form->textarea('description', ll('Description'))->rules('max:255');
        $form->url('download_url', ll('Download url'))->rules('required');
        $form->radio('client_type', ll('Client type'))->options($this->clientText)->default(AppVersion::CLIENT_TYPE['ANDROID']);
        $form->radio('upgrade_type', ll('Upgrade type'))->options($this->upgradeText)->default(AppVersion::UPGRADE_TYPE['REMIND']);

        $form->saving(function (Form $form) {


            $isMax = AppVersion::isMaxVersion($form->client_type, $form->version, $form->isCreating() ?: $form->model()->id);

            if (!$isMax) {
                return form_error(ll('version below before'));
            }

        });
        return $form;
    }
}
