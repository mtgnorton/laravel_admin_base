<?php

namespace App\Admin\Controllers;

use App\Admin\Components\Actions\BackupRun;
use App\Admin\Components\Actions\TestMultiFile;
use App\Define\PostDefine;
use App\Model\Post;
use App\Model\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Callout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $this->title = ll('Post');
    }

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->row(new Callout("
                注意事项注意事项注意事项注意事项

            ", "注意事项", 'info'))
            ->body($this->grid());
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid()
    {
        $grid = new Grid(new Post());
        $grid->filter(function ($filter) {

            /**
             * @var $filter Grid\Filter
             */

            $filter->column(1 / 2, function ($filter) {
                /**
                 * @var $filter Grid\Filter
                 */
                $filter->like('title', ll('标题'));
                $filter->like('user_id', ll('用户'))->select(User::pluck('username', 'id'));

            });
            $filter->column(1 / 2, function ($filter) {
                /**
                 * @var $filter Grid\Filter
                 */
                $filter->between('created_at', ll('创建时间'))->datetime();

            });
        });

        $grid->model()->collection(function (Collection $collection) {
            return $collection->map(function ($item) {
                $item->comments_amount = mt_rand(0, 100);
                return $item;
            });
        });
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new TestMultiFile());

        });
        $grid->column('id', ll('Id'));
        $grid->column('title', ll('Title'));
        $grid->column('user_id', ll('User id'));
        $grid->column('cover_path', ll('Cover'))->gallery();

        /*自适应modal*/
        $grid->column('image_modal', ll('See image'))->customModal(ll("Cover"), function ($model) {
            $imagePath = Storage::disk(config('admin.upload.disk'))->url($this->cover_path);
            return <<<EOT
<img src="{$imagePath}" style="width:100%;height:100%"  class="img">
EOT;
        }, "fa-arrows-alt", "1200px", "800px");


        $grid->column('comments_amount', ll('Comments amount'));
        $grid->column('content', ll('Content'))->display(function ($value, $column) {


            /**
             * @var \Encore\Admin\Grid\Column $column
             */

            /**
             * @var \App\Model\Post $this
             */
            return htmlspecialchars(Str::limit($value, 100));
        });
        $grid->column('type', ll('Type'))->using(PostDefine::typeText())->label([
            PostDefine::TYPE['MILITARY']   => 'default',
            PostDefine::TYPE['SCIENCE']    => 'info',
            PostDefine::TYPE['LITERATURE'] => 'warning',
        ]);


        $grid->column('created_at', ll('Created at'));
        $grid->column('updated_at', ll('Updated at'));

        return $grid;
    }


    public function detail($id)
    {
        $show = new Show(Post::findOrFail($id));
        // show_disabled_edit_and_delete($show);;

        $show->field('title', ll('Title'));
        $show->field('cover_path', ll('Cover'))->image();
        $show->field('type', ll('Type'))->as(function ($value) {

            /**
             * @var \App\Model\Post $this
             */
            return PostDefine::typeText()[$value];
        });
        return $show;

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = new Form(new Post());

        $form->number('user_id', ll('User id'));

        $form->file("html", ll('html'))->options([
            'allowedPreviewTypes' => ['image', 'text', 'video', 'audio', 'flash', 'object']
        ]);


        $form->display('username', ll('Username'))->with(function ($value, $column) {

            /**
             * @var \Encore\Admin\Form\Field\Display $column
             */

            /**
             * @var \App\Model\Post $this
             */

            if ($user = User::find($this->user_id)) {
                return $user->username;
            }
            return "";
        });
        $form->image('cover_path', ll('Cover'))->uniqueName()->required();
        $form->text('title', ll('Title'));

        $form->radio('type', ll('Type'))->options(PostDefine::typeText());

        /*文本编辑器+上传图片*/
        $form->fullEditor('content', ll('Content'));


        return $form;
    }


}
