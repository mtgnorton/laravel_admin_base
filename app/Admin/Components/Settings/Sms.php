<?php

namespace App\Admin\Components\Settings;

use App\Model\Symbol;

class Sms extends Base
{

    public function tabTitle()
    {
        return ll('Sms setting');
    }

    /**
     * Build a form here.
     */
    public function form()
    {

        $this->divider(ll('huan hui setting'));

        $this->text('huan_hui_user_id', ll('huan hui user id'));
        $this->text('huan_hui_account', ll('huan hui account'));
        $this->text('huan_hui_password', ll('huan hui password'));

        $this->divider(ll('secure setting'));
        $this->number('sms_send_diff_min', ll('Sms code send diff min'))->rules('required|numeric|min:0')->help(ll('if the value is 0,not limit'));
        $this->number('sms_send_day_max', ll('Sms code send day max'))->rules('required|numeric|min:0')->help(ll('if the value is 0,not limit'));
        $this->number('sms_effective_time', ll('Sms code effective time'))->rules('required|numeric|min:0')->help(ll('if the value is 0,not limit'));
    }


}
