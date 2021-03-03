<?php

namespace App\Admin\Controllers;

use App\Model\DocumentCategory;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Tree;

class DocumentCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;

    public function __construct()

    {
        $this->title = ll('Document category');
    }


    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->body($this->tree());

    }

    public function tree()
    {
        return new Tree(new DocumentCategory(), function (Tree $tree) {
            $tree->branch(function ($branch) {

                return "{$branch['id']} - {$branch['title']}";

            });
        });


    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DocumentCategory());

        $form->display('id', 'ID');

        $form->text('title', ll('Category title'));
        $form->select('parent_id', ll('Parent'))->options(DocumentCategory::selectOptions());

        return $form;
    }
}
