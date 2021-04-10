<?php

namespace App\Service\Notification;

use App\Model\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * author: mtg
 * time: 2021/2/27   9:59
 * class description:短信通知基类
 * @package App\Service\Notification
 */
abstract class Sms
{
    abstract public function send(string $target, $content): bool;

    /**
     * author: mtg
     * time: 2021/2/27   10:00
     * function description:发送短信验证码
     * @param string $target 手机号
     * @param int|string $type 短信类型,如注册验证码,找回密码验证码
     * @return string
     */
    public function sendAuthCode(string $target, string $type = Message::Type['REGISTER_CODE']): bool
    {
        $siteName   = conf('site_name');
        $expireTime = conf('sms_effective_time');
        $code       = mt_rand(100000, 999999);


        $content = conf('auth_code_content');

        eval("\$content = \"$content\";");


        $this->checkLimit($target);

        $this->send($target, $content);

        Message::create([
            'user_id' => Auth::id() ?? 0,
            'target'  => $target,
            'content' => $content,
            'code'    => $code,
            'ip'      => request()->ip(),
            'type'    => $type,
        ]);

        return true;
    }

    /**
     * author: mtg
     * time: 2021/4/10   10:27
     * function description: 发送提示内容
     * @param string $target 手机号
     * @param int $type 发送的内容类型
     */
    public function sendGeneral(string $target, $type = Message::Type['HELLO_WORLD'])
    {
        $content = "";
        switch ($type) {
            case Message::Type['HELLO_WORLD'] :
                $content = conf('template_hello_word');
                break;
        }
        if (!$content) {
            return false;
        }
        $siteName = conf('site_name');

        eval("\$content = \"$content\";");
        $this->send($target, $content);
        return true;
    }

    /**
     * author: mtg
     * time: 2021/2/27   10:01
     * function description: 验证验证码
     * @param string $target 手机号
     * @param string $code 验证码
     * @param int|string $type 短信类型,如注册验证码,找回密码验证码
     * @return bool
     */
    public function validateAuthCode(string $target, string $code, string $type = Message::Type['REGISTER']): bool
    {
        if (env('APP_DEBUG') && $code == "~~~~~~") {
            return true;
        }

        $diffMin = conf('sms_effective_time');

        $message = Message::where(
            [
                'target' => $target,
                'type'   => $type,
            ]
        )->orderByDesc('id')->first();


        if (!$message) {
            new_api_exception(ll('auth code error'));
        }

        if ($message->isUsed()) {
            new_api_exception(ll('auth code has used'));

        }
        if ($diffMin > 0 && $message->created_at->lt(Carbon::now()->addMinutes(-$diffMin))) {
            new_api_exception(ll('auth code has expire'));
        }
        if (!$message->validateCode($code)) {
            new_api_exception(ll('auth code error'));
        }


        return true;

    }

    /**
     * author: mtg
     * time: 2021/3/2   12:10
     * function description:标记验证码已被使用
     * @param string $mobile
     * @param string $code
     */
    public function useAuthCode(string $mobile, string $code)
    {
        Message::where([
            'target' => $mobile,
            'code'   => $code
        ])->update([
            'is_use' => 1
        ]);
    }


    /**
     * author: mtg
     * time: 2021/2/27   10:01
     * function description: 检查发送限制
     * @param string $target 手机号
     * @return bool
     */
    public function checkLimit(string $target): bool
    {
        $diffTime = conf('sms_send_diff_min');
        $dayMax   = conf('sms_send_day_max');

        $messages = Message
            ::where('target', $target)
            ->where('type', '<=', 20)
            ->whereBetween('created_at', get_time_begin_end('d', 1))->orderByDesc('id')->get();

        if ($messages->isEmpty()) {
            return true;
        }
        $firstMessage = $messages->first();

        if ($diffTime > 0 && $firstMessage->created_at->gt(Carbon::now()->addMinutes(-$diffTime))) {
            new_api_exception(ll('auth code send frequent'));
        }

        if ($dayMax > 0 && $messages->count() >= $dayMax) {
            new_api_exception(ll('auth code beyond max send amount'));
        }
        return true;
    }


}
