<?php

namespace App\Service;


use App\Services\Gather\CrawlService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use ZipArchive;

class SystemUpdateService
{
    static protected $srcFileAmount = 0;

    static protected $finishAmount = 0;


    /**
     * author: mtg
     * time: 2021/7/3   14:57
     * function description: 在线更新
     * @param string $src
     * @param string $dst
     */
    static public function update($patchURL)
    {

        $zipFullPath = storage_path('update/patch.zip');

        $temp          = pathinfo($zipFullPath);
        $parentZipPath = $temp['dirname'];
        $unZipFullPath = $temp['dirname'] . DIRECTORY_SEPARATOR . $temp['filename'];


        if (!is_dir($parentZipPath) && !mkdir($parentZipPath, 0777, true)) {
            return [
                'state'   => 0,
                'message' => '压缩文件父目录创建失败'
            ];
        }

        $fullZipPath = CrawlService::download($patchURL, $zipFullPath);

        $rs = ZipService::unzip($fullZipPath, $unZipFullPath);


        if ($rs !== true) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }
        $src = $unZipFullPath;

        $sqlFile = $src . '/' . 'modify.sql';

        $sqlAmount = 0;
        if (file_exists($sqlFile)) {
            list($sqlAmount, $errorAmount) = DatabaseService::sqlExecute(file_get_contents($sqlFile));
            unlink($sqlFile);
        }

        $dst = realpath('../');

        self::$srcFileAmount = FileService::calculateFileAmount($src);

        if (!is_numeric(self::$srcFileAmount)) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }


        self::info(sprintf("文件总数量为%s\r\n", self::$srcFileAmount));


        $rs = FileService::mergeDir($src, $dst, function ($finishAmount) {
            self::$finishAmount++;
        });
        if ($rs !== true) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }

        FileService::deleteDir(storage_path('update/'));

        return [
            'state'      => 1,
            'amount'     => self::$finishAmount,
            'sql_amount' => $sqlAmount
        ];
    }


    static public function info(string $message)
    {
        gather_log($message . "\r\n");
    }


}
