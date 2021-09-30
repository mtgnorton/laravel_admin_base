<?php

namespace App\Service;



class FileService
{


    /**
     * author: mtg
     * time: 2021/7/3   14:35
     * function description 获取目录中php文件的数量
     * @param $dir
     * @return false
     */
    static public function calculateFileAmount(string $dir)
    {
        static $fileAmount = 0;
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
                $fileAmount++;
            }
        }
        closedir($handle);

        return $fileAmount;

    }

    /**
     * author: mtg
     * time: 2021/7/3   14:58
     * function description:将$src中的文件递归合并到$dst中
     * @param string $src
     * @param string $dst
     * @return false
     */
    static public function mergeDir(string $src, string $dst, $callback = null)
    {
        $src = rtrim($src, '/');
        $dst = rtrim($dst, '/');
        static $finishAmount = 0;

        if (!is_dir($src)) {
            return true;
        }
        clearstatcache();

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

                    mkdir($dstPath, 0777, true);
                }

                self::mergeDir($srcPath, $dstPath, $callback);

            } else {

                if (is_file($srcPath)) {
                    self::info(sprintf('由%s复制到%s', $srcPath, $dstPath));

                    try {
                        copy($srcPath, $dstPath);

                    } catch (\Exception $e) {
                        self::info('拷贝文件不存在' . full_error_msg($e));

                        continue;
                    }
                    $finishAmount++;
                    if ($callback) {
                        $callback($finishAmount);
                    }
                }

            }
        }

        closedir($handle);

        return true;
    }


    /**
     * author: mtg
     * time: 2021/7/15   15:38
     * function description:复制文件夹,如果目标文件夹存在,删除目标文件夹
     */
    static public function copyDir($src, $dst)
    {
        if (file_exists($dst)) {
            self::deleteDir($dst);
        }

        if (is_dir($src)) {
            mkdir($dst);
            $files = scandir($src);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    self::copyDir("$src/$file", "$dst/$file");
                }
            }

        } else if (file_exists($src)) {
            copy($src, $dst);

        }
        return true;
    }


    /**
     * author: mtg
     * time: 2021/7/3   14:37
     * function description: 删除目录
     * @param $dir
     * @return bool
     */
    public static function deleteDir(string $dir)
    {
        $dir = rtrim($dir, '/') . '/';
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
        return rmdir($dir); //todo windows 为空无法删除的问题
    }


    /**
     * author: mtg
     * time: 2021/7/15   15:47
     * function description: 创建文件,如果父文件夹不存在,则创建父文件夹
     * @param string $file
     * @return bool
     */
    static public function createFile(string $file)
    {
        $info = pathinfo($file);
        if (!is_dir($info['dirname'])) {
            mkdir($info['dirname']);
        }
        if (!is_file($file)) {
            $f = fopen($file, 'w');
            fclose($f);
        }
        return true;
    }


    static public function info(string $message)
    {
        common_log($message . "\r\n");
    }


    static public function completePath($path)
    {
        return str_replace('\\', '/', $path);
    }

}
