<?php

namespace App\Admin\Components\Actions;

use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupRun extends Action
{
    protected $selector = '.backup';

    public function handle(Request $request)
    {
        // $request ...
        if (is_win()) {
            return $this->response()->error(__('win not support backup'))->refresh();
        }
        try {
            ini_set('max_execution_time', 300);

            // start the backup process
            Artisan::call('backup:run --disable-notifications --only-db');

            $output = Artisan::output();

            return $this->response()->success(__('Backup success'))->refresh();

        } catch (\Exception $e) {
            return $this->response()->error($e->getMessage())->refresh();
        }
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success backup">备份</a>
HTML;
    }
}
