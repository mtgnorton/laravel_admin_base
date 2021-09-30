<?php

namespace App\Service;


use ZipArchive;

class ZipService
{


    /**
     * author: mtg
     * time: 2021/7/15   11:35
     * function description: 文件夹压缩
     * @param array $paths
     * @param string $zipFile
     */
    public static function zip(string $path, string $directDir, string $zipFile)
    {

        is_file($zipFile) && @unlink($zipFile);

        // 如果压缩文件不存在，就创建压缩文件
        if (!is_file($zipFile)) {
            FileService::createFile($zipFile);
        }

        $zip = new \ZipArchive();
        // OVERWRITE选项表示每次压缩时都覆盖原有内容，但是如果没有那个压缩文件的话就会报错，所以事先要创建好压缩文件
        // 也可以使用CREATE选项，此选项表示每次压缩时都是追加，不是覆盖，如果事先压缩文件不存在会自动创建

        if (!is_file($path) && !is_dir($path)) {
            return false;
        }

        if ($zip->open($zipFile, \ZipArchive::CREATE) === true) {
            self::addFileToZip($path, $directDir, $zip);
            $zip->close();
        } else {
            return '打开zip文件失败';
        }


    }

    private static function addFileToZip($path, $directDir, $zip)
    {
        $handler = opendir($path); //打开当前文件夹由$path指定。

        $directDir = rtrim($directDir, '/');
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..'，不要对他们进行操作
                if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
                    self::addFileToZip($path . "/" . $filename, $directDir . '/' . $filename, $zip);
                } else { //将文件加入zip对象
                    $zip->addFile($path . "/" . $filename, $directDir . '/' . $filename);
                }
            }
        }
        @closedir($path);
    }


    /**
     * author: mtg
     * time: 2021/7/3   15:30
     * function description:将压缩文件$srcZip解压到$unzipPath中
     * @param string $srcZip
     * @param $unzipPath
     * @return bool
     */
    static public function unzip(string $srcZip, string $unzipPath)
    {
        $zip  = new ZipArchive();
        $flag = $zip->open($srcZip);
        if ($flag !== true) {
            return '打开压缩包失败' . $flag;
        }
        $zip->extractTo($unzipPath);
        $flag = $zip->close();

        if (!$flag) {
            return '解压失败';
        }
        return true;
    }

}
