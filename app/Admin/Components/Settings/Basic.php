<?php

namespace App\Admin\Components\Settings;

use App\Model\Config;
use App\Model\Symbol;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '网站设置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $keyValues = $request->all();

        collect($keyValues)->map(function ($v, $k) {

            Config::updateOrInsert(
                [
                    'key' => $k
                ],
                [
                    'value' => $v
                ]);
        });

        admin_success(__('Update success'));

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->text('site_name',__("Site name"))->rules('required');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return Config::pluck('value', 'key');
    }
}
