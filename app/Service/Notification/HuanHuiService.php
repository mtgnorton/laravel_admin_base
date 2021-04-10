<?php

namespace App\Service\Notification;


use Illuminate\Support\Str;

/**
 * author: mtg
 * time: 2021/2/27   9:58
 * class description:
 * @package App\Service\NotifyUser
 */
class HuanHuiService extends Sms
{


    public function send(string $target, $content): bool
    {

        $userID   = conf('huan_hui_user_id', 'sms');
        $account  = conf('huan_hui_account', 'sms');
        $password = conf('huan_hui_password', 'sms');
        $content  = urlencode($content);

        $request = "http://47.104.1.60:8888/sms.aspx?action=send&userid={$userID}&account={$account}&password={$password}&mobile={$target}&sendTime=&extno=&content={$content}";

        $rs = curl_get($request, false);


        $successMsg = '<message>ok</message>';
        if (Str::contains($rs, $successMsg)) {
            return true;
        }
        preg_match('/<message>(.*?)<\/message>/', $rs, $errorMsg);

        $throwMsg = ll("sms service can't use,");

        if (array_value($errorMsg, 1)) {
            $throwMsg .= ll('error msg is:') . $errorMsg[1];
        }
        new_api_exception($throwMsg);


    }


}
