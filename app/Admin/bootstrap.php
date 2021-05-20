<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Admin\Components\Actions\ClearCache;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Column;

Encore\Admin\Form::forget(['map']);

Grid::init(function (Grid $grid) {
    $grid->model()->orderBy('id', 'desc');

    $grid->actions(function (Grid\Displayers\Actions $actions) {
//        $actions->disableView();
    });
    $grid->filter(function (Grid\Filter $filter) {
        $filter->expand();
        $filter->disableIdFilter();
    });
});

Form::init(function (Form $form) {


    $form->disableViewCheck();

    $form->tools(function (Form\Tools $tools) {
        $tools->disableView();
    });
});

Column::extend('customModal', \App\Admin\Components\Actions\CustomModal::class);

Column::extend('bold', function ($value) {
    return "<span style='font-weight:700'>$value</span>";
});

Form::extend("fullEditor", \App\Admin\Components\Fields\FullEditor::class);


app('view')->prependNamespace('admin', resource_path('views/admin'));
Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {

    $navbar->right(new ClearCache());


});
