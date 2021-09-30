<?php


namespace App\Service;


use Composer\Util\Zip;
use Illuminate\Support\Facades\DB;
use PDO;
use PhpParser\Node\Expr\Cast\Object_;

class ImportAndExportService
{

    public static function export()
    {


        FileService::mergeDir(storage_path('app/public/template'), storage_path('migration/template'));
        FileService::mergeDir(storage_path('app/public/ad'), storage_path('migration/ad'));


        DatabaseService::exportDatabase(['admin_menu', 'admin_permissions', 'admin_role_menu', 'admin_role_permissions', 'admin_role_users', 'admin_roles', 'admin_user_permissions', 'admin_users', 'configs'], storage_path('migration/migration.sql'));
        force_notify('数据表导出完成,开始执行文件压缩');


        ZipService::zip(storage_path('migration'), '', FileService::completePath(public_path('seo/migration.zip')));
//        FileService::deleteDir(storage_path('migration'));

    }


    public static function import(object $file)
    {
        $file->move(storage_path(), 'migration.zip');
        ZipService::unzip(storage_path('migration.zip'), storage_path('migration'));
        $sqlFile = storage_path('migration/migration.sql');

        if (is_file($sqlFile)) {
            $sqlContent = file_get_contents($sqlFile);
            $sqlContent = str_replace('0000-00-00 00:00:00', '2021-07-16 00:00:00', $sqlContent);
            list($successAmount, $errorAmount) = DatabaseService::sqlExecute($sqlContent);

            force_notify(sprintf('sql导入完成,成功数量为%s,失败数量为%s', $successAmount, $errorAmount));
            unlink($sqlFile);
        }


        $fileTotalAmount = FileService::calculateFileAmount(storage_path('migration'));

        FileService::mergeDir(storage_path('migration'), storage_path('app/public'), function ($finishAmount) use ($fileTotalAmount) {
            $percent = intval($finishAmount / $fileTotalAmount * 100);

            force_notify(sprintf("文件导入 [%s%%] - 100%%", $percent));
        });

        force_notify('文件导入完成');
    }
}

?>
