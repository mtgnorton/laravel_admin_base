<?php

namespace App\Admin\Controllers;

use App\Model\Advert;
use App\Model\AdvertCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Storage;

class AdvertController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title;


    public function __construct()
    {
        $this->title = ll('Advert manage');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Advert());

        $grid->column('id', ll('Id'));
        $grid->column('name', ll('Advert name'));
        $grid->column('identifying', ll('Advert identify or url'));
        $grid->column('image_path', ll('Advert image'))->image();
        $grid->column('image_modal', ll('See image'))->customModal(ll("Advert image"), function ($model) {
            $imagePath = Storage::disk(config('admin.upload.disk'))->url($this->image_path);
            return <<<EOT
<img src="{$imagePath}" style="max-width:1200px;max-height:800px;overflow:auto;" class="img">
EOT;
        });
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
        $form = new Form(new Advert());

        $form->select("category_id", ll('Advert category'))->options(function () {
            return AdvertCategory::select(['name', 'id', 'width', 'height'])->get()->mapWithKeys(function ($item) {
                return [
                    $item['id'] => $item['name'] . " | {$item['width']}*{$item['height']}"
                ];
            });
        })->rules('required');

        $form->text('name', ll('Advert name'))->rules('required');
        $form->text('identifying', ll('Advert identify or url'))->rules('required');
        $form->image('image_path', ll('Advert image'))->uniqueName()->rules('required');
        $form->number('sort', ll('Sort'))->default(0)->help(ll('The value smaller the show more forward'));
        $form->switch('is_disabled', ll('Is disabled'));

        return $form;
    }
}
