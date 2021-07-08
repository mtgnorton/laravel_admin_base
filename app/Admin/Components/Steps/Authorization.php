<?php

namespace App\Admin\Components\Steps;


use App\Model\Config;
use App\Service\CrawlService;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class Authorization extends StepForm
{
    /**
     * The form title.
     *
     * @var  string
     */
    public $title = '请填写授权信息';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {

        return $this->next($request->all());

    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('code', '授权码')->required()->value(conf('auth.code'));
        $this->text('domain', '授权域名')
            ->required()
            ->help('如www.baidu.com,30天只能绑定一次')
            ->value(conf('auth.domain'));
    }
}
