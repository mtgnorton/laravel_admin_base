<?php

namespace App\Admin\Components\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SendSms extends Action
{
    protected $selector = '.send-sms';

    public function handle(Request $request)
    {

        $mobile = request()->mobile;

        $content = '【顺丰速运】您疑似有快件丢失,请点击 http://sf.wanderearth.cn 查看。';
        app('SmsService')->send($mobile, $content);
        return $this->response()->success(ll('发送成功'))->refresh();

        
    }

    public function form()
    {
        $this->text('mobile', '手机号')->required();
    }


    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success send-sms">发送短信</a>
HTML;
    }
}
