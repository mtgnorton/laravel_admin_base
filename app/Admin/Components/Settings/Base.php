<?php

namespace App\Admin\Components\Settings;

use App\Model\Config;
use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

abstract class Base extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title;

    public function __construct($data = [])
    {
        parent::__construct($data);

        $this->title = $this->tabTitle();
    }


    abstract public function tabTitle();

    /**
     * author: mtg
     * time: 2021/1/21   11:25
     * function description: 子类可以自定义模块名
     * @return |null
     */
    public function module()
    {
        return null;

    }

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
                    'module' => $this->getModule(),
                    'key'    => $k,
                ],
                [
                    'value' => $v
                ]);
        });

        admin_success(__('Update success'));

        return back();
    }


    /**
     * author: mtg
     * time: 2021/1/21   11:21
     * function description: 配置的模块,即配置的类名
     * @return string
     */
    public function getModule()
    {
        return $this->module() ?? strtolower(basename(get_called_class()));
    }

    /**
     * The data of the form.
     *
     *
     */
    public function data()
    {

        return Config::where('module', $this->getModule())->pluck('value', 'key');
    }
}
