<?php

namespace App\Admin\Components\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class TestMultiFile extends Action
{
    protected $selector = '.upload';

    public function handle(Request $request)
    {
        dump(21);
        exit;
    }

    public function form()
    {
        $this->multipleFile('files');
    }


    public function html()
    {
        return <<<HTML
       <a class="btn btn-sm btn-success upload">多文件上传</a>

HTML;
    }
}
