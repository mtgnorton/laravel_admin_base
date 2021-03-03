<?php

namespace App\Admin\Controllers;

use App\Model\Announcement;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AnnouncementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;


    public function __construct()
    {
        $this->title = ll('Announcement manage');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Announcement());

        $grid->column('id', ll('Id'));
        $grid->column('title', ll('Announcement title'));
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
        $form = new Form(new Announcement());

        $form->text('title', ll('Announcement title'))->required();
        $form->fullEditor('content', ll('Announcement Content'))->required();
        $form->number('sort', ll('Sort'))->default(0)->help(ll('The value smaller the show more forward'));
        $form->switch('is_disabled', ll('Is disabled'));


        return $form;
    }
}
