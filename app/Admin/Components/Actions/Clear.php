<?php

namespace App\Admin\Components\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Clear extends Action
{
    protected $selector = '.clear';

    public function handle(Request $request)
    {

        $this->clear();
        return $this->response()->success('清空成功')->refresh();

    }


    public function clear()
    {
        DB::statement('truncate table users');
        DB::statement('truncate table user_recommend_relation');

    }


    public function dialog()
    {
        $this->confirm('确定清空？');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-warning clear">清空业务数据</a>
HTML;
    }
}
