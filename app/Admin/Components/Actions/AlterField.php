<?php


namespace App\Admin\Components\Actions;


use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterField extends RowAction
{
    protected $selector = '.alter-field';

    public function handle(Request $request)
    {
        $actualIncAmount = $this->alter();

        return $this->response()->success('新增字段的数量为' . $actualIncAmount)->refresh();
    }


    public function alter()
    {
        $alterFile   = \Storage::disk('sql')->get('z_alter.sql');
        $sqlContents = explode(';', $alterFile);

        $actualIncAmount = 0;

        $db = DB::connection();
        foreach ($sqlContents as $sql) {

            $sql = trim($sql);
            if (!$sql) {
                continue;
            }

            try {

                preg_match('/ADD\s+([^\s]+)\s+/i', $sql, $matches);

                $alterField = $matches[1];

                preg_match('/Table\s+([^\s]+)\s+add/i', $sql, $matches);

                $table = $matches[1];

                if (!$alterField || !$table) {
                    continue;
                }

                if (!Schema::hasColumn($table, $alterField)) { //没有则写入
                    $actualIncAmount++;
                    $db->getPdo()->exec($sql);
                }


            } catch (\Exception $e) {
                dump($sql, $e->getMessage());
                exit;
            }
        }
        return $actualIncAmount;
    }


    public
    function dialog()
    {
        $this->confirm('确定写入？');
    }

    public
    function display($value)
    {
        return <<<HTML
        <a class="btn btn-sm btn-primary alter-field">写入新增字段</a>
HTML;
    }
}
