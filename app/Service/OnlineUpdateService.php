<?php

namespace App\Services;

use App\Service\CrawlService;
use ZipArchive;

class OnlineUpdateService
{
    static protected $srcPHPFileAmount = 0;

    static protected $finishAmount = 0;

    /**
     * author: mtg
     * time: 2021/7/3   14:35
     * function description 获取目录中php文件的数量
     * @param $dir
     * @return false
     */
    static public function calculateFileAmount(string $dir)
    {
        $dir = rtrim($dir, '/');

        $handle = opendir($dir);

        if (!$handle) {
            return "计算文件数量时打开文件夹失败";
        }
        while (($file = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $path = $dir . '/' . $file;

            if (is_dir($path)) {
                self::calculateFileAmount($path);

            } else {
                $infos = explode('.', $file);

                self::$srcPHPFileAmount++;
//                if (strtolower($infos[count($infos) - 1]) == 'php') {
//
//                }
            }
        }
        closedir($handle);

        return true;

    }


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


        $rs = self::unzip($fullZipPath, $unZipFullPath);

        if ($rs !== true) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }
        $src = $unZipFullPath;
        $dst = realpath('../');

        $rs = self::calculateFileAmount($src);

        if ($rs !== true) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }

        self::info(sprintf("文件总数量为%s\r\n", self::$srcPHPFileAmount));

        $rs = self::merge($src, $dst);
        if ($rs !== true) {
            return [
                'state'   => 0,
                'message' => $rs
            ];
        }
        self::deleteDir(storage_path('update/'));
        return [
            'state'  => 1,
            'amount' => self::$finishAmount
        ];
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
            return '打开压缩包失败';
        }
        $zip->extractTo($unzipPath);
        $flag = $zip->close();

        if (!$flag) {
            return '解压失败';
        }
        return true;
    }

    /**
     * author: mtg
     * time: 2021/7/3   14:58
     * function description:将$src中的文件递归合并到$dst中
     * @param string $src
     * @param string $dst
     * @return false
     */
    static public function merge(string $src, string $dst)
    {
        $src = rtrim($src, '/');
        $dst = rtrim($dst, '/');

        $handle = opendir($src);
        if (!$handle) {
            return "合并文件时,打开源文件夹失败";
        }
        while (($file = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;

            if (is_dir($srcPath)) {
                if (!is_dir($dstPath)) {
                    mkdir($dstPath, 0777);
                }

                self::merge($srcPath, $dstPath);

            } else {
                self::info(sprintf('由%s复制到%s', $srcPath, $dstPath));
                self::$finishAmount++;
                $percent = intval(self::$finishAmount / self::$srcPHPFileAmount * 100);
                self::info(sprintf("在线更新进度 [%s%%] - 100%%", $percent));
                copy($srcPath, $dstPath);
            }
        }

        closedir($handle);

        return true;
    }

    /**
     * author: mtg
     * time: 2021/7/3   14:37
     * function description: 删除目录
     * @param $dir
     * @return bool
     */
    static public function deleteDir(string $dir)
    {
        //如果是目录则继续
        if (is_dir($dir)) {
            //扫描一个文件夹内的所有文件夹和文件并返回数组
            $p = scandir($dir);
            //如果 $p 中有两个以上的元素则说明当前 $dir 不为空
            if (count($p) > 2) {
                foreach ($p as $val) {
                    //排除目录中的.和..
                    if ($val != "." && $val != "..") {
                        //如果是目录则递归子目录，继续操作
                        if (is_dir($dir . $val)) {
                            //子目录中操作删除文件夹和文件
                            self::deleteDir($dir . $val . '/');
                        } else {
                            //如果是文件直接删除
                            unlink($dir . $val);
                        }
                    }
                }
            }
        }
        //删除目录
        return rmdir($dir);
    }


    static public function info(string $message)
    {
        gather_log($message . "\r\n");
    }
}
