<?php

namespace App\Admin\Components\Settings;

use App\Model\Symbol;

class Storage extends Base
{

    public function tabTitle()
    {
        return ll('Storage setting');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->radio("storage_type", ll('Storage type'))->options([
            'admin'     => ll('Local'),
            'ali_cloud' => ll('Ali yun')
        ])->default('ali_cloud')->help(ll("the value modify,before upload will cant see"));
        $this->divider(ll('Aliyun storage setting'));

        $this->text('access_id');
        $this->text('access_key');
        $this->text('bucket');
        $this->text('endpoint');
    }


}
