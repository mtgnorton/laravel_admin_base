<?php

namespace App\Admin\Components\Settings;

use App\Model\Symbol;

class SmsTemplate extends Base
{

    public function tabTitle()
    {
        return ll('Sms template setting');
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $authCode = '【{$siteName}】验证码：{$code}，{$expireTime}分钟内有效,切勿告知他人！';

        $this->textarea('auth_code_content', ll('auth code'))->default($authCode)->help(ll("{} inside content don't modify"));


        $templateHelloWorld = '【{$siteName}】 hello world';

        $this->textarea('template_hello_word', ll('hello world'))->default($templateHelloWorld)->help(ll("{} inside content don't modify"));


    }


}
