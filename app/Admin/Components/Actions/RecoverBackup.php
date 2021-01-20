<?php

namespace App\Admin\Components\Actions;

use App\ApiException;
use App\Model\Backup;
use App\Model\User;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class RecoverBackup extends RowAction
{
    public $name = '备份恢复';

    public function handle(Backup $backup, Request $request)
    {

        $filePath = Backup::getFilePathByModifyTime($backup->id);
        $disk     = Backup::getBackupDisk();

        $fullPath = realpath($disk->getAdapter()->getPathPrefix() . $filePath);

        try {
            $sqlFile = $this->getSqlFile($fullPath, Backup::getTempDir());

        } catch (ApiException $e) {
            return $this->response()->info($e->getMessage())->refresh();
        }

        $fileReadFun = function ($sqlFile) {

            $handle = fopen($sqlFile, 'r');
            while (!feof($handle)) {
                yield fgets($handle);
            }
            fclose($handle);
        };

        $lines = $fileReadFun($sqlFile);
        $block = '';
        foreach ($lines as $line) {
            $block .= $line;
            if (Str::contains($line, ';')) {
                DB::connection()->getPdo()->exec($block);
                $block = '';
            }
        }
        unlink($sqlFile);

        return $this->response()->info(__('Recover success'))->refresh();
    }

    // 这个方法来根据`star`字段的值来在这一列显示不同的图标
    public function display($star)
    {

        return '<i class="fa fa-recycle"></i>';
    }

    public function dialog()
    {
        $this->confirm(__('Confirm recover'));
    }

    public function getSqlFile(string $fullPath, string $tempDir)
    {
        $zip  = new ZipArchive();
        $flag = $zip->open($fullPath);
        if ($flag !== true) {
            new_api_exception('unzip error');
        }
        $zip->extractTo($tempDir);
        $zip->close();

        $allFiles = Storage::allFiles('backup-temp');
        if (!$allFiles) {
            new_api_exception('sql file not exist');
        }
        if (count($allFiles) > 1) {
            new_api_exception('sql file number not correct');
        }
        return (realpath(storage_path('app/' . array_pop($allFiles))));


    }

}
