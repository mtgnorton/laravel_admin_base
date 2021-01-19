<?php

namespace App\Admin\Controllers;

use App\Model\Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Storage;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;


    public function __construct()
    {
        $this->title = __('Post');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->bold();
        $grid->column('user_id', __('User id'));
        $grid->column('cover_path', __('Cover'))->gallery();

        /*自适应modal*/
        $grid->column('image_modal', __('See image'))->customModal(__("Cover"), function ($model) {
            $imagePath = Storage::disk(config('admin.upload.disk'))->url($this->cover_path);
            return <<<EOT
<img src="{$imagePath}" style="width:100%;height:100%"  class="img">
EOT;
        }, "fa-arrows-alt", "1200px", "800px");


        $grid->column('content', __('Content'))->limit();
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
        $form = new Form(new Post());

        $form->number('user_id', __('User id'));
        $form->image('cover_path', __('Cover'))->uniqueName()->required();
        $form->text('title', __('Title'));

        /*文本编辑器+上传图片*/
        $form->fullEditor('content', __('Content'));

        return $form;
    }
}
