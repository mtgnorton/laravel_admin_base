<?php

namespace App\Admin\Components\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecoverOrigin extends Action
{
    protected $selector = '.recover-origin';

    public function handle(Request $request)
    {

        $this->recover();

        return $this->response()->success('清空成功')->refresh();

    }


    public function recover()
    {
        $sqlFiles = Storage::disk('sql')->allFiles();
        $db       = DB::connection();

        foreach ($sqlFiles as $sqlFile) {
            $sqlContent  = Storage::disk('sql')->get($sqlFile);
            $sqlContents = explode(';', $sqlContent);

            foreach ($sqlContents as $sql) {
                $sql = trim($sql);
                if (!$sql) {
                    continue;
                }
                try {
                    $db->getPdo()->exec($sql);
                } catch (\Exception $e) {
                    dump($sql, $e->getMessage());
                    exit;
                }
            }

        }
    }


    public function dialog()
    {
        $this->confirm('确定恢复？');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-danger recover-origin">恢复原始数据</a>
HTML;
    }
}
